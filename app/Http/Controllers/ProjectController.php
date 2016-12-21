<?php

namespace Iplan\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Iplan\Entity\Project;
use Illuminate\Support\Facades\Auth;
use Iplan\Repositories\Contracts\UserRepository;
use Iplan\Http\Requests;

class ProjectController extends Controller
{
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $user
     *
     */
    public function __construct(UserRepository $user)
    {
        $this->userRepo = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the currently authenticated user.
        $user = Auth::user();

        //Get all projects
        $projects = Project::where('user_id', '=', $user->id)->paginate(10);
        return view('projects.project', ['projects' => $projects]);

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get a specific project details via id
        $projects = Project::where('id', '=',$id)->first();
        return view('projects.single-project', ['projects' => $projects]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
