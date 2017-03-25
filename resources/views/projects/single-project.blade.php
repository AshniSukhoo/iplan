@extends('layouts.app')

@section('title')
    {{ $project->name }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 style="text-align: center">{{ $project->name}}</h1>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">
                        Actions <i class="fa fa-bolt" aria-hidden="true"></i>
                    </div>

                    <div class="panel-body">
                        <div class="spark-settings-tabs">
                            <ul class="nav spark-settings-stacked-tabs" role="tablist">
                                <li role="presentation">
                                    <a href="{{ route('home') }}">
                                        <i class="fa fa-dashboard" aria-hidden="true"></i>
                                        Back to Dashboard
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href=" {{route('work-items.create', ['project_id'=>$project->id ]) }}">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        Create new work item
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                        Owner: {{ $project->owner->id == Auth::user()->id ? 'You' : $project->owner->first_name }}
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="{{ route('members.index', ['project' => $project->id]) }}">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                        Members
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        Created:
                                        <abbr title="{{ $project->created_at->toDayDateTimeString() }}">
                                            {{ $project->created_at->diffForHumans()}}
                                        </abbr>
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        Updated:
                                        <abbr title="{{ $project->updated_at->toDayDateTimeString() }}">
                                            {{ $project->updated_at->diffForHumans()}}
                                        </abbr>
                                    </a>
                                </li>
                            </ul>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    @can('modify', $project)
                                    <a class="btn btn-primary btn-block"
                                       href="{{ route('projects.edit', ['id'=>$project->id ]) }}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        Edit project
                                    </a>
                                    @endcan
                                </div>

                                <div class="col-md-12">
                                    @can('modify', $project)
                                    <form onsubmit="return confirm('Are you sure you want to delete this project ?')"
                                          action="{{ route('projects.destroy', ['id'=>$project->id ]) }}" method="POST">
                                        {{ method_field('DELETE') }}

                                        {{ csrf_field() }}

                                        <button type="submit" class="btn btn-danger btn-block">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            Delete
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">

                    <div class="panel-body">
                        @if(session('success_message'))
                            <div class="alert alert-success">
                                {{ session('success_message') }}
                            </div>
                        @endif

                        @if(count($errors))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <p class="desc-text text-justify">
                            <b>Project description:</b>
                            {!! $project->description !!}
                        </p>

                    </div>

                    <div class="panel-body">
                        <h4>
                            <a href="{{ route('work-items.index', ['project_id'=>$project->id ]) }}">
                                <i class="fa fa-list-ul" aria-hidden="true"></i>
                                Show work items of project
                            </a>
                        </h4>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

