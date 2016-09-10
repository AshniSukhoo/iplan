<?php

namespace Iplan\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Iplan\Commands\RegisterNewUser;
use Iplan\Http\Controllers\Controller;
use Iplan\Http\Requests\Auth\RegistrationRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    
    use RegistersUsers;
    
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  RegistrationRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegistrationRequest $request)
    {
        // Process Registration of User.
        return $this->dispatch(new RegisterNewUser($request->all()));
    }
}
