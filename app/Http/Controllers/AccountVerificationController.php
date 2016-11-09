<?php

namespace Iplan\Http\Controllers;

use Illuminate\Http\Request;
use Iplan\Entity\VerificationToken;
use Iplan\Repositories\Contracts\VerificationTokenRepository;
use Iplan\Repositories\Contracts\UserRepository;
use Iplan\Http\Requests;
use Auth;

class AccountVerificationController extends Controller
{
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * The verificationToken repository instance.
     *
     * @var VerificationTokenRepository
     */
    protected $verificationTokenRepo;

    /**
     * Create a new controller instance.
     *
     * @param VerificationTokenRepository $token
     * @param  UserRepository  $user
     *
     */
    public function __construct(VerificationTokenRepository $token, UserRepository $user)
    {
        $this->userRepo = $user;
        $this->verificationTokenRepo = $token;
    }

    /**
     * Verify user's account.
     *
     * @param VerificationToken $verificationToken
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getVerifiedToken(VerificationToken $verificationToken)
    {
        //Get the user.
        $user = $verificationToken->user;

        //Verify the user account.
        $this->userRepo->verifyUser($user);

        //Delete token associate with the user.
        $this->verificationTokenRepo->delete($verificationToken->id);

        //Log user in.
        Auth::login($user);

        //Redirect user on home page.
        return redirect('/home');
    }
}
