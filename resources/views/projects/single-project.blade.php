@extends('layouts.app')

@section('title')
   {{ $project->name }}
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
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <p class="desc-text text-justify">
                            <b>Project name:</b>
                            {{ $project->name}}
                        </p>

                        <p class="desc-text text-justify">
                            <b>Project description:</b>
                            {{ $project->description}}
                        </p>

                        <p class="desc-text text-justify">
                            <b>Project created at:</b>
                            <abbr title="{{ $project->created_at->toDayDateTimeString() }}">
                                {{ $project->created_at->diffForHumans()}}
                            </abbr>
                        </p>

                            <a class="btn btn-primary" href="{{ route('projects.edit', ['id'=>$project->id ]) }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Edit project
                            </a>

                            <a class="btn btn-danger" href="{{ route('projects.destroy', ['id'=>$project->id ]) }}">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                Delete
                            </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

