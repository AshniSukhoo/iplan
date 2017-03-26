@extends('layouts.app')

@section('title')
    My profile
@stop

@section('content')
    <div class="container">
        <br>
        <br>

        <div class="row" id="main">
            @include('users.partials._left-profile-panel', ['user' => $user])
            <div class="col-md-8 well" id="rightPanel">
                <div class="row">
                    <div class="col-md-12">
                        @if(session('success_message'))
                            <div class="alert alert-success">
                                {{ session('success_message') }}
                            </div>
                        @endif
                        <h2>
                            My Profile.
                            <small>This is who I am.</small>
                        </h2>
                        <hr class="colorgraph">
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <h3>Name</h3>
                                <h4>{{ $user->full_name }}</h4>
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <h3>Job title</h3>
                                <h4>{{ !empty($user->job_title) ? $user->job_title : 'Not specified' }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <h3>Company Name</h3>
                                <h4>{{ !empty($user->company_name) ? $user->company_name : 'Not specified' }}</h4>
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <h3>Email</h3>
                                <h4>{{ $user->email }}</h4>
                            </div>
                        </div>
                        <hr class="colorgraph">
                        @can('edit', $user)
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-md-offset-6">
                                <a href="{{ route('profile.edit', ['user' => $user->id]) }}"
                                   class="btn btn-primary btn-block">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                </a>
                            </div>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


