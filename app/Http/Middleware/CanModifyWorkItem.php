<?php

namespace Iplan\Http\Middleware;

use Closure;
use Iplan\Entity\Project;
use Iplan\Entity\WorkItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class CanModifyWorkItem
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     *
     * @throws AuthorizationException
     */
    public function handle($request, Closure $next)
    {
        // Get Logged in user.
        $loggedInUser = Auth::user();

        //Get work item id
        $id = $request->route('work_item');
        $project_id = $request->route('project_id');

        $workItem = WorkItem::findOrFail($id);
        $project = Project::findOrFail($project_id);

        if($loggedInUser->can('modify', [$workItem, $project])) {
            return $next($request);
        }

        // User not allowed to see this page.
        throw new AuthorizationException;
    }
}
