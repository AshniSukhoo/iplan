<?php

namespace Iplan\Http\Controllers;

use Iplan\Entity\User;
use Iplan\Http\Requests;
use Iplan\Entity\Project;
use Illuminate\Http\Request;
use Iplan\Notifications\AddedAsMemberToProject;

class ProjectMembersController extends Controller
{
    /**
     * ProjectMembersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('projects.can.access')->only([
            'index'
        ]);

        $this->middleware('projects.can.modify')->only([
            'store', 'destroy', 'searchNonMembers'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Project $project
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        // Get Members of the Project.
        $members = $project->members()
                           ->paginate(10);

        // Return view with Data.
        return view('project-members.index', [
            'members' => $members,
            'project' => $project
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Project $project
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project, Request $request)
    {
        $this->validate($request, ['project_member' => 'required']);

        // Get Member.
        $member = User::findOrFail($request->project_member);

        // Member is already owner.
        if ($member->id == $project->owner->id) {
            return redirect()->route('members.index', ['project' => $project])
                             ->withErrors([$member->full_name . ' is already the owner of the project.']);
        }

        // Member is already a member.
        if ($project->members()->where('users.id', $member->id)->count() > 0) {
            return redirect()->route('members.index', ['project' => $project])
                             ->withErrors([$member->full_name . ' is already a member of the project.']);
        }

        // Add Member to the project.
        $project->members()->attach($member->id);

        // Notify User he has been added to project.
        $member->notify(new AddedAsMemberToProject($project));

        return redirect()->route('members.index', ['project' => $project])
                         ->with([
                             'success_message' => $member->full_name . ' has been added to your project as a member.'
                         ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, $id)
    {
        // Find the User.
        $user = User::findOrFail($id);

        // User is not a member.
        if ($project->members()->where('users.id', $id)->count() == 0) {
            return redirect()->route('members.index', ['project' => $project])
                             ->withErrors(['User is not a member of this project.']);
        }

        // Detach User from project.
        $project->members()->detach($id);

        return redirect()->route('members.index', ['project' => $project])
                         ->with([
                             'success_message' => $user->full_name . ' has been removed from your project as a member.'
                         ]);
    }

    /**
     * Find Members on a project.
     *
     * @param Project $project
     * @param Request $request
     *
     * @return Response
     */
    public function searchMembers(Project $project, Request $request)
    {
        // Search for Users
        $users = $project->members()
                         ->where('first_name', 'like', $request->name . '%')
                         ->orWhere('last_name', 'like', $request->name . '%')
                         ->orWhere('email', 'like', '%' . $request->name . '%')
                         ->orWhere(\DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'like', $request->name . '%')
                         ->get();

        // If we have users.
        if ($users->isEmpty()) {
            return [];
        }

        return [
            'items' => $users->transform(function ($user) {
                return [
                    'id' => $user->id,
                    'text' => $user->full_name
                ];
            })
        ];
    }

    /**
     * Find Non Members on a project.
     *
     * @param Project $project
     * @param Request $request
     *
     * @return Response
     */
    public function searchNonMembers(Project $project, Request $request)
    {
        // Search for Users
        $users = User::where('first_name', 'like', $request->name . '%')
                     ->orWhere('last_name', 'like', $request->name . '%')
                     ->orWhere('email', 'like', '%' . $request->name . '%')
                     ->orWhere(\DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'like', $request->name . '%')
                     ->get();

        // If we have users.
        if ($users->isEmpty()) {
            return [];
        }

        return [
            'items' => $users->transform(function ($user) {
                return [
                    'id' => $user->id,
                    'text' => $user->full_name
                ];
            })
        ];
    }
}
