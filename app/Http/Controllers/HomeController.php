<?php

namespace Iplan\Http\Controllers;

use Auth;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['index']);
        $this->middleware('guest')->only(['getWelcomePage']);
    }

    /**
     * Load Welcome Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWelcomePage()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', [
            'numProjectsCreated'         => $this->getNumOfProjectCreated(),
            'numAssignedProjects'        => $this->getNumAssignedProjects(),
            'numWorItemsToComplete'      => $this->getNumOpenWkItm(),
            'profilePercentageCompleted' => $this->getPercentageProfileCompleted(),
            'recentProjects'             => $this->getRecentProjects(),
            'recentWorkItems'            => $this->getRecentWorkItems(),
        ]);
    }

    /**
     * Get Number of Project created.
     *
     * @return int
     */
    protected function getNumOfProjectCreated()
    {
        return Auth::user()->projects()->count();
    }

    /**
     * Get number of assigned projects.
     *
     * @return int
     */
    protected function getNumAssignedProjects()
    {
        return Auth::user()->projectsUserIsMemberOf()->count();
    }

    /**
     * Get number of open work items.
     *
     * @return int
     */
    protected function getNumOpenWkItm()
    {
        return Auth::user()->assignedWorkItems()->where('status', 'open')->count();
    }

    /**
     * Get percentage profile completed.
     *
     * @return string
     */
    protected function getPercentageProfileCompleted()
    {
        // Fields that can be
        // fill by the user.
        $fieldsOfProfile = [
            'first_name',
            'last_name',
            'job_title',
            'company_name',
            'bio',
            'email',
        ];

        // Count how many fields are completed.
        $fieldsCompleted = 0;
        foreach ($fieldsOfProfile as $field) {
            if (! empty(Auth::user()->$field) && ! is_null(Auth::user()->$field)) {
                $fieldsCompleted++;
            }
        }

        // Calculate percentage completed and return.
        return floor(($fieldsCompleted / count($fieldsOfProfile)) * 100).'%';
    }

    /**
     * Get recent projects.
     *
     * @return Collection
     */
    protected function getRecentProjects()
    {
        // Get 3 recent Projects user created.
        $recentlyCreated = Auth::user()->projects()->orderBy('updated_at', 'desc')->limit(3)->get();

        // Get 3 recent Projects user assigned.
        $recentlyAssigned = Auth::user()->projectsUserIsMemberOf()->orderBy('updated_at', 'desc')->limit(3)->get();

        return $recentlyCreated->merge($recentlyAssigned);
    }

    /**
     * Get recent work items.
     *
     * @return Collection
     */
    protected function getRecentWorkItems()
    {
        // Get 3 recently created work items.
        $recentlyCreated = Auth::user()->createdWorkItems()->orderBy('updated_at', 'desc')->limit(3)->get();

        // Get 3 recently assigned work items.
        $recentlyAssigned = Auth::user()->assignedWorkItems()->orderBy('updated_at', 'desc')->limit(3)->get();

        return $recentlyCreated->merge($recentlyAssigned);
    }
}
