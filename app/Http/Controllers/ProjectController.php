<?php

namespace Iplan\Http\Controllers;

use Iplan\Entity\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * ProjectController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('projects.can.access')->except([
            'index', 'create', 'store', 'searchUser', 'getAssignedProject'
        ]);

        $this->middleware('projects.can.modify')->only([
            'edit', 'update', 'destroy'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get the currently authenticated user.
        $user = $request->user();

        // Get all projects => Project::where('user_id', '=', $user->id)
        $projects = $user->projects()
                         ->with('workItemsOfProject')
                         ->paginate(6);

        // Return View with projects.
        return view('projects.project', ['projects' => $projects, 'title' => 'My Projects']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Load the view with create new project forrm
        return view('projects.create-new-project');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //set validations rules
        $this->validate($request, [
            'new_project_name' => 'required',
            'new_project_description' => 'required'
        ]);

        // Saving data inputted
        $project = Project::create([
            'name' => $request->input('new_project_name'),
            'description' => $request->input('new_project_description'),
            'user_id' => Auth::user()->id
        ]);

        // Go to Single Project Created.
        return redirect(route('projects.show', ['id' => $project->id]))->with([
            'success_message' => 'The project was sucessfully created.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get the Specific project using it's ID.
        $project = Project::where('id', '=', $id)->first();

        // Load the view with project
        return view('projects.single-project', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get the Specific project first using it's ID.
        $project = Project::where('id', '=', $id)->first();

        // Load the view form with project fields
        return view('projects.edit-single-project', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //set validations rules
        $this->validate($request, [
            'project_name' => 'required',
            'project_description' => 'required'
        ]);

        // Get project with specific id and update the rows
        $projectWasUpdated = Project::where('id', '=', $id)->update([
            'name' => $request->input('project_name'),
            'description' => $request->input('project_description')
        ]);

        // Check if Update was successful.
        if ($projectWasUpdated) {
            return redirect(route('projects.show', ['id' => $id]))->with([
                'success_message' => 'Project was updated sucessfully'
            ]);
        } else {
            return redirect(route('projects.edit', ['id' => $id]))->withErrors([
                'An error occurred, could not update Project'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get project with specific id and delete the row
        $projectWasDeleted = Project::where('id', '=', $id)->delete();

        // Check if Project was deleted.
        if ($projectWasDeleted) {
            return redirect(route('projects.index'))->with([
                'success_message' => 'Project was deleted'
            ]);
        } else {
            return redirect(route('projects.show'))->withErrors([
                'Sorry an error occured, could not deleted project.'
            ]);
        }
    }

    /**
     * Get projects that user is a member of.
     *
     * @param Project $project
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAssignedProject(Request $request)
    {
        //Get the currently user.
        $user = $request->user();

        //Get all assigned project ID of project members
        $assignedProjects = $user->projectsUserIsMemberOf()
                                 ->with('workItemsOfProject')
                                 ->paginate(6);

        // Return View with projects.
        return view('projects.project', ['projects' => $assignedProjects, 'title' => 'Assigned Projects']);
    }
}
