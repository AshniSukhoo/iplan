<?php

namespace Iplan\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Iplan\Entity\User;
use Iplan\Http\Controllers\Controller;
use Iplan\Repositories\Contracts\Entity\AccountStatusRepository;
use Validator;

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
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Validate User data
        $this->validator($request->all())->validate();
        
        // Create User.
        return $this->create($request->all());
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'            => 'required|max:255',
            'last_name'             => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return \Illuminate\Http\Response
     */
    protected function create(array $data)
    {
        // Get Account status
        $accountStatus = app()->make(AccountStatusRepository::class)->findByField('status', 'unconfirmed');
        
        // No account status found
        if ($accountStatus->isEmpty()) {
            return redirect($this->redirectPath())->withErrors([
                'message' => 'Could not find account status to associate to user.'
            ]);
        }
        
        // Create User
        User::create([
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'account_status_id' => $accountStatus->first()->id,
            'email'             => $data['email'],
            'password'          => bcrypt($data['password']),
        ]);
        
        // Go to Homepage
        return redirect($this->redirectPath())->with([
            'message' => 'Your account has been created'
        ]);
    }
}
