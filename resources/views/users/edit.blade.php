@extends('layouts.app')

@section('title')
    Edit my profile
@stop

@section('css')
    <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <br>
        <br>

        <div class="row" id="main">
            @include('users.partials._left-profile-panel', ['user' => $user])
            <div class="col-md-8 well" id="rightPanel">
                <div class="row">
                    <div class="col-md-12">
                        @if(count($errors))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('profile.update', ['user' => $user->id]) }}" method="post" role="form">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <h2>Edit your profile.
                                <small>It's always easy</small>
                            </h2>
                            <hr class="colorgraph">

                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="first_name" id="first_name"
                                               class="form-control input-lg" value="{{ $user->first_name }}"
                                               placeholder="First Name" tabindex="1">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="last_name" id="last_name" class="form-control input-lg"
                                               value="{{ $user->last_name }}" placeholder="Last Name" tabindex="2">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="job_title" id="job_title" class="form-control input-lg"
                                               value="{{ $user->job_title }}" placeholder="Job Title" tabindex="3">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="company_name" id="company_name"
                                               class="form-control input-lg" value="{{ $user->company_name }}"
                                               placeholder="Company Name" tabindex="4">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" class="form-control input-lg"
                                               value="{{ $user->email }}" placeholder="Email" tabindex="5">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <textarea name="bio" id="bio"
                                                  class="form-control input-lg" tabindex="6">{{ $user->bio }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="colorgraph">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="password" name="password" id="password"
                                               class="form-control input-lg" placeholder="Password" tabindex="7">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="password" name="confirm_password" id="confirm_password"
                                               class="form-control input-lg" placeholder="Confirm Password"
                                               tabindex="8">
                                    </div>
                                </div>
                            </div>
                            <hr class="colorgraph">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-md-offset-6">
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fa fa-check" aria-hidden="true"></i> Save Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#bio').summernote({
                height: 200,
            });
        });
    </script>
@stop


