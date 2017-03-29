<?php

namespace Iplan\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Show User notifications.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get the User.
        $user = $request->user();

        // Get Notifications
        $notifications = $user->notifications()->paginate(10);

        // Mark as Read.
        $notifications->markAsRead();

        return view('notifications.index', [
            'notifications' => $notifications,
        ]);
    }
}
