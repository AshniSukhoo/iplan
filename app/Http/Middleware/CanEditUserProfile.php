<?php

namespace Iplan\Http\Middleware;

use Closure;

class CanEditUserProfile
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
        // Get User being edited.
        $userBeingEdited = $request->route('user');

        // Not the user profile so we redirect the user to his profile.
        if($request->user()->cannot('edit', $userBeingEdited)) {
            return redirect()->route('profile.show', ['user' => $request->user()->id]);
        }

        return $next($request);
    }
}
