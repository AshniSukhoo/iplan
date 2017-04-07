<?php

namespace Iplan\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Iplan\Entity\User;
use Iplan\Entity\WorkItem;
use Iplan\Http\Requests;
use Iplan\Entity\Project;
use Illuminate\Support\Facades\Auth;
use Iplan\Notifications\AssignWorkItemToMember;
use Iplan\Notifications\UpdatedWorkItem;
use Iplan\Notifications\WorkItemCreated;

class WorkItemController extends Controller
{
    /*
     * Work Item constructor
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('projects.can.access')->only([
            'index', 'create', 'store', 'autoCompleteWorkItemsSearch'
        ]);

        $this->middleware('work-items.can.access')->only(['show']);

        $this->middleware('work-items.can.modify')->only([
            'edit', 'update', 'destroy'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param int $project_id
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $project_id)
    {
        //Get the project associated with that work item
        $project = Project::where('id', '=', $project_id)->first();

        // Create  query to select workitem with associated project id for a specific user
        $workItems = $project->workItemsOfProject()->orderBy('priority')->orderBy('updated_at', 'desc');

        if ($request->has('status')) {
            $workItems->where('status', '=', $request->status);
        }

        if ($request->has('search_work_item_title')) {
            $workItems->where('title', 'LIKE', $request->search_work_item_title . '%');

        }

        // Return View with workitems.
        return view('workitems.workitems', [
            'workItems' => $workItems->paginate(6),
            'project' => $project
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id)
    {
        //Get the project associated with that work item
        $project = Project::where('id', '=', $project_id)->first();


        // Load the view with create new work item form while passing the project variable
        return view('workitems.create-new-work-item', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project_id)
    {
        //set validations rules
        $this->validate($request, [
            'new_work_item_title'          => 'required',
            'new_work_item_description'    => 'required',
            'new_work_item_estimated_time' => 'required',
            'new_work_item_type'           => 'required',
            'new_work_item_priority'       => 'required',
        ]);

        if ($request->input('new_work_item_assigned_user') != '') {
            $assingedUser = User::findOrFail($request->input('new_work_item_assigned_user'));
        } else {
            $assingedUser = null;
        }

        if ($request->input('new_work_item_parent') != '') {
            $parentId = $request->input('new_work_item_parent');
        } else {
            $parentId = null;
        }

        // Saving data inputted
        $workitem = WorkItem::create([
            'title'          => $request->input('new_work_item_title'),
            'description'    => $request->input('new_work_item_description'),
            'estimated_time' => $request->input('new_work_item_estimated_time'),
            'type'           => $request->input('new_work_item_type'),
            'priority'       => $request->input('new_work_item_priority'),
            'user_id'          => Auth::user()->id,
            'project_id'       => $project_id,
            'assigned_user_id' => $assingedUser ? $assingedUser->id : null,
            'parent_id'        => $parentId,
        ]);

        //get project
        $project = Project::findOrFail($project_id);

        // Check if work item has assigned user
        if (!is_null($assingedUser) && !Auth::user()->is($assingedUser)) {
            // Notify User.
            $assingedUser->notify(
                new AssignWorkItemToMember(Auth::user(), $project, $workitem)
            );
        }

        // Check if user is not project owner
        if (!Auth::user()->is($project->owner)) {
            $project->owner->notify(
                new WorkItemCreated(Auth::user(), $project, $workitem)
            );
        }

        // Go to Single work item Created.
        return redirect(route('work-items.show', ['id' => $workitem->id, 'project_id' => $project_id]))->with([
            'success_message' => 'The work item was successfully created.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id, $id)
    {
        $project = Project::find($project_id);

        // Get the Specific work item using it's ID.
        $workitem = WorkItem::where('id', '=', $id)->firstOrFail();

        // Load the view with project
        return view('workitems.single-workitem', [
            'project' => $project,
            'workitem' => $workitem
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id, $id)
    {
        //Get the project associated with that work item
        $project = Project::where('id', '=', $project_id)->first();

        // Get  Work Item we are editing
        $workItem = $project->workItemsOfProject()->where('id', '=', $id)->first();

        // Load the view form with work items fields
        return view('workitems.edit-single-work-item', [
            'project' => $project,
            'workItem' => $workItem
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param int $project_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project_id, $id)
    {
        // Set validations rules
        $this->validate($request, [
            'work_item_title'          => 'required',
            'work_item_description'    => 'required',
            'work_item_estimated_time' => 'required',
            'work_item_type'           => 'required',
            'work_item_priority'       => 'required',
        ]);

        if ($request->input('work_item_assigned_user') != '') {
            $assingedUser = User::findOrFail($request->input('work_item_assigned_user'));
        } else {
            $assingedUser = null;
        }

        if ($request->input('work_item_parent') != '') {
            $parentId = $request->input('work_item_parent');
        } else {
            $parentId = null;
        }

        // Get work item
        $workItem = WorkItem::findorFail($id);

        // Get project
        $project = Project::findOrFail($project_id);

        // Check if assigned User has changed.
        $assignedUserHasChanged = false;
        if (is_null($workItem->assignedUser) || (!is_null($assingedUser) && !$workItem->assignedUser->is($assingedUser))) {
            $assignedUserHasChanged = true;
        }

        $workItemWasUpdated = $workItem->update([
            'title'            => $request->input('work_item_title'),
            'description'      => $request->input('work_item_description'),
            'estimated_time'   => $request->input('work_item_estimated_time'),
            'type'             => $request->input('work_item_type'),
            'priority'         => $request->input('work_item_priority'),
            'status'           => $request->input('work_item_status'),
            'user_id'          => Auth::user()->id,
            'project_id'       => $project_id,
            'assigned_user_id' => $assingedUser ? $assingedUser->id : null,
            'parent_id'        => $parentId,
        ]);

        // Check if work item has assigned user
        if (!is_null($assingedUser) && !Auth::user()->is($assingedUser)) {
            if($assignedUserHasChanged) {
                // Notify User.
                $assingedUser->notify(
                    new AssignWorkItemToMember(Auth::user(), $project, $workItem->fresh())
                );
            } else {
                $assingedUser->notify(
                    new UpdatedWorkItem(Auth::user(), $project, $workItem->fresh())
                );
            }
        }

        // Check if Update was successful.
        if ($workItemWasUpdated) {
            return redirect(route('work-items.show', ['id' => $id, 'project_id' => $project_id]))->with([
                'success_message' => 'Work item was updated successfully'
            ]);
        } else {
            return redirect(route('work-items.edit', ['id' => $id, 'project_id' => $project_id]))->withErrors([
                'An error occurred, could not update Project'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id, $id)
    {

        //Search project id
        $project = Project::find($project_id);

        //Get Work item associated with project via id
        $workItemWasDeleted = WorkItem::where('id', '=', $id)->delete();


        //Check if work item was deleted
        if ($workItemWasDeleted) {
            return redirect(route('work-items.index', ['project_id' => $project_id]))->with([
                'success_message' => 'Work Item was deleted'
            ]);
        } else {
            return redirect(route('work-items.show', ['id' => $id, 'project_id' => $project_id]))->withErrors([
                'Sorry an error has occurred, could not delete work item!'
            ]);
        }
    }


    /**
     * @param Request $request
     * @param Project $project
     * @return array
     *
     * search for parent work item
     */
    public function autoCompleteWorkItemsSearch(Request $request, Project $project)
    {
        //search for work item
        $workItems = $project->workItemsOfProject()
                             ->where('title', 'like', $request->parent . '%')
                             ->get();

        if ($workItems->isEmpty()) {
            return [];
        }

        return [
            'items' => $workItems->transform(function ($workItem) {
                return [
                    'id' => $workItem->id,
                    'text' => $workItem->title
                ];
            })
        ];
    }
}
