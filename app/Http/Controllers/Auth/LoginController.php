<?php

namespace Iplan\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Iplan\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    use AuthenticatesUsers;
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public $redirectTo = '/home';
    
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    /**
     * The user has been authenticated.
     *
     * @param  Request $request
     * @param  mixed   $user
     *
     * @return Response
     */
    protected function authenticated(Request $request, $user)
    {
        // Path User intended to go to.
        $path = session()->pull('url.intended', null);
        
        // We have intended path.
        if(!is_null($path) && $path != route('page.welcome')) {
            return redirect($path);
        }
        
        // Return to Homepage.
        return redirect(
            $this->redirectPath()
        );
    }
}
