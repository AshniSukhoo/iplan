<?php

namespace Iplan\Http\Controllers;

use Iplan\Entity\User;
use Iplan\Http\Requests;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * UserProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('profile.can.edit')->only(['edit', 'update']);
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'same:confirm_password|min:6',
            'confirm_password' => 'min:6'
        ]);

        // Save profile.
        $user->fill([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'job_title' => $request->job_title,
            'company_name' => $request->company_name,
            'bio' => $request->bio
        ]);

        if ($request->has('password') && !empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        // Save user.
        $user->save();

        // Save Successfully.
        return redirect()->route('profile.show', ['user' => $user->id])
                         ->with(['success_message' => 'Profile saved successfully !!']);
    }
}
