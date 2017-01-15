@extends('layouts.app')

@section('title')
    My project-Create new
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Create  new project</h1>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">

                        @if(count($errors))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('projects.store')  }}">

                            <input type="hidden" name="_method" value="POST">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="new_project_name" class="col-md-4 control-label">Project Name</label>

                                <div class="col-md-6">
                                    <input id="new_project_name" type="text" class="form-control" name="new_project_name" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new_project_description" class="col-md-4 control-label">Project Description</label>

                                <div class="col-md-6">
                                    <textarea id="new_project_description" class="form-control" name="new_project_description"> </textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-wrench" aria-hidden="true"></i>
                                Save project
                            </button>

                            <a class="btn btn-danger" href="{{ route('home') }}">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop