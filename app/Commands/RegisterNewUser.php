<?php

namespace Iplan\Commands;

use Iplan\Mail\VerifyAccountEmail;
use Iplan\Repositories\Contracts\AccountStatusRepository;
use Iplan\Repositories\Contracts\UserRepository;
use Mail;

class RegisterNewUser
{
    /**
     * New User data.
     */
    protected $data;
    
    /**
     * Redirect path to login.
     *
     * @var string
     */
    protected $redirectLogin = 'login';
    
    /**
     * Redirect path to register.
     *
     * @var string
     */
    protected $redirectRegister = 'register';
    
    /**
     * User Repository.
     *
     * @var UserRepository
     */
    protected $userRepository;
    
    /**
     * Account Status Repository.
     *
     * @var AccountStatusRepository
     */
    protected $accountStatusRepository;
    
    /**
     * Create a new command instance.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
        $this->userRepository = app()->make(UserRepository::class);
        $this->accountStatusRepository = app()->make(AccountStatusRepository::class);
    }
    
    /**
     * Execute the command.
     *
     * @return \Illuminate\Http\Response
     */
    public function handle()
    {
        // Create User
        $user = $this->createUser();
        
        // Could not create User.
        if (is_null($user)) {
            return $this->redirectRegisterPath([
                'message' => 'Sorry we could not create your account, try again later.'
            ]);
        }
        
        // Send Email.
        Mail::to($user)->send(new VerifyAccountEmail());
        
        // Go to login when register is successfull.
        return $this->redirectLoginPath([
            'message' => 'Your account has been created, we sent you an email to verify your account.'
        ]);
    }
    
    /**
     * Create User.
     *
     * @return \Iplan\Entity\User|null
     */
    protected function createUser()
    {
        // Get Account status
        $accountStatus = $this->accountStatusRepository->findByField('status', 'unconfirmed');
        
        // No account status found
        if ($accountStatus->isEmpty()) {
            return null;
        }
        
        // Create User
        return $this->userRepository->createWithToken([
            'first_name'        => $this->data['first_name'],
            'last_name'         => $this->data['last_name'],
            'account_status_id' => $accountStatus->first()->id,
            'email'             => $this->data['email'],
            'password'          => bcrypt($this->data['password']),
        ]);
    }
    
    /**
     * Go to Register page.
     *
     * @param array $withErrors
     *
     * @return \Illuminate\Http\Response
     */
    protected function redirectRegisterPath($withErrors = [])
    {
        return redirect($this->redirectRegister)->withErrors($withErrors);
    }
    
    /**
     * Go to login page.
     *
     * @param array $with
     *
     * @return \Illuminate\Http\Response
     */
    protected function redirectLoginPath($with = [])
    {
        return redirect($this->redirectLogin)->with($with);
    }
}
