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
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get Logged in user.
        $loggedInUser = Auth::user();

        // Project id.
        $id = $request->route('project');

        if (is_null($id)) {
            $id = $request->route('project_id');
        }

        if($id instanceof Project) {
            $project = $id;
        } else {
            // Get Project.
            $project = Project::findOrFail($id);
        }

        if ($loggedInUser->can('access', $project)) {
            // Middleware passed.
            return $next($request);
        }

        return redirect(route('projects.index'));
    }
}
