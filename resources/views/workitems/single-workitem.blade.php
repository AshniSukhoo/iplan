@extends('layouts.app')

@section('title')
    {{ $workitem->title }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 style="text-align: center">{{ $workitem->title}}</h1>
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
                                    <a href="{{ route('projects.index') }}">
                                        <i class="fa fa-file" aria-hidden="true"></i>
                                        My Projects
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="{{ route('work-items.index', ['project_id'=>$project->id ]) }}">
                                        <i class="fa fa-tasks" aria-hidden="true"></i>
                                        My Work items
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
                                        Work item owner: {{ Auth::user()->first_name }}
                                    </a>
                                </li>

                                <li  role="presentation">
                                    <a href="">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        Work item created:
                                        <abbr title="{{ $workitem->created_at->toDayDateTimeString() }}">
                                            {{ $workitem->created_at->diffForHumans()}}
                                        </abbr>
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        Work item last updated:
                                        <abbr title="{{ $workitem->updated_at->toDayDateTimeString() }}">
                                            {{ $workitem->updated_at->diffForHumans()}}
                                        </abbr>
                                    </a>
                                </li>
                            </ul>

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
                            <b>Work item description:</b>
                            {!! $workitem->description !!}
                        </p>
                    </div>   <!--/.panel-body-->

                    <div class="panel-body">
                        <div class="col-md-3 ">
                            @if(Auth::user()->id == $project->user_id)
                                <a class="btn btn-primary btn-block" href="{{ route('work-items.edit', ['project_id' => $project->id, 'work-item_id' => $workitem->id  ]) }}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    Edit Work item
                                </a>
                            @endif
                        </div>

                        <div class="col-md-3">
                            @if(Auth::user()->id == $project->user_id)
                                <form onsubmit="return confirm('Are you sure you want to delete this project ?')" action="{{ route('projects.destroy', ['id'=>$project->id ]) }}" method="POST">
                                    {{ method_field('DELETE') }}

                                    {{ csrf_field() }}

                                    <button type="submit" class="btn btn-danger btn-block">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>  <!--/.panel-body-->


                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

