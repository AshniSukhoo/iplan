@extends('layouts.app')

@section('title')
    My project-Edit
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ $project->name}}</h1>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-3">
                @include('projects.sidebarmenu')
            </div>

            <div class="col-md-9">
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
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('projects.update', ['id'=>$project->id ]) }}">

                            {{ method_field('PUT') }}

                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="project_name" class="control-label">Project Name</label>
                                    <input id="project_name" type="text" class="form-control" name="project_name" value="{{ $project->name }}" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="project_description" class="control-label">Project Description</label>
                                    <textarea id="project_description" class="form-control" name="project_description"> {{ $project->description }} </textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-wrench" aria-hidden="true"></i>
                                Update project
                            </button>

                            <a class="btn btn-danger" href="{{ route('projects.show', ['id' => $project->id]) }}">
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

@section('js')
    <script>
        $(document).ready(function() {
            $('#project_description').summernote({
                height: 300,
            });
        });
    </script>
@endsection
