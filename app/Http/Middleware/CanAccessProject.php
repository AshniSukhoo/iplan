<?php

namespace Iplan\Http\Middleware;

use Closure;
use Iplan\Entity\Project;
use Illuminate\Support\Facades\Auth;

class CanAccessProject
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get Logged in user.
        $loggedInUser = Auth::user();

        // Project id.
        $id = $request->route('project');

        // Get Project.
        $project = Project::findOrFail($id);

        // Check if User cannot access project.
        if($project->user_id != $loggedInUser->id) {
            return redirect(route('projects.index'));
        }

        // Middleware passed.
        return $next($request);
    }
}
