<?php

namespace Iplan\Http\Controllers;

use Iplan\Entity\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
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
                         ->paginate();
        
        // Return View with projects.
        return view('projects.project', ['projects' => $projects]);
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
            'new_project_name'        => 'required',
            'new_project_description' => 'required'
        ]);

        //saving data inputted
        $project = Project::create([
            'name' => $request->input('new_project_name'),
            'description' => $request->input('new_project_description'),
            'user_id' => Auth::user()->id
        ]);

        // Go to Single Project Created.
        return redirect(route('projects.show', ['id' => $project->id]));
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
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //set validations rules
        $this->validate($request, [
            'project_name'        => 'required',
            'project_description' => 'required'
        ]);

        //Get project with specific id and update the rows
        $project = Project::where('id', '=', $id)->update([
            'name' => $request->input('project_name'),
            'description' => $request->input('project_description')
        ]);

        return redirect(route('projects.show', ['id' => $id]));
    }
    
    /**
     * Remove the specified resource from storage.

     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
