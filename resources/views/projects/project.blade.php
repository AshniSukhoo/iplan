@extends('layouts.app')

@section('title')
    {{ $title }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ $title }}</h1>
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
                                    <a href="{{ route('assignedProject') }}">
                                        <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                        Assigned Projects
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="{{ route('projects.create') }}">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        Create new project
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @if(! $projects->isEmpty())
                <div class="col-md-9">
                    @if(session('success_message'))
                        <div class="alert alert-success">
                            {{ session('success_message') }}
                        </div>
                    @endif

                    @foreach ($projects->chunk(3) as $projectRow)
                        <div class="row">
                            @foreach($projectRow as $project)
                                <div class="col-md-4">
                                    <div class="project project-info">
                                        <div class="shape">
                                            <div class="shape-text">
                                                {{ $project->percentageCompleted }}
                                            </div>
                                        </div>
                                        <div class="project-content">
                                            <h3 class="lead">
                                                {{ $project->name }}
                                            </h3>
                                            <p>
                                                {{ str_limit(strip_tags($project->description),50,'...') }}
                                            </p>

                                            <div class="project-button">
                                                <a class="btn btn-info"
                                                   href="{{ route('projects.show', ['id' => $project->id]) }}">
                                                    Open
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--/.row-->
                    @endforeach

                    @if($projects->hasPages())
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <!--create the pagination links using the render method-->
                                {{ $projects->render() }}
                            </div>
                        </div>
                        <!--/.row-->
                    @endif
                </div>
            @else
                <div class="col-md-9">
                    @include('projects.no-project-found')
                </div>
                <!--/.col-->
            @endif
        </div>
        <!--/row-->
    </div>
    <!--/container -->
@endsection

