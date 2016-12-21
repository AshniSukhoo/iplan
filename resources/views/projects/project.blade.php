@extends('layouts.app')

@section('title')
    My projects
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1> My projects </h1>
            </div>
        </div>
        <hr/>
        <div class="row">
            @if(! $projects->isEmpty())
                @foreach ($projects as $project)
                    <div class="col-xs-3">
                        <div class="project project-info">
                            <div class="shape">
                                <div class="shape-text">
                                </div>
                            </div>
                            <div class="project-content">
                                <h3 class="lead">
                                    {{ $project->name }}
                                </h3>
                                <p>
                                    {{ str_limit($project->description,50,'...') }}
                                </p>

                                <div class="project-button">
                                    <a class="btn btn-info" href="{{ route('projects.show', ['id' => $project->id]) }}">
                                        Open
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="project-pagination-link">
                    <!--create the pagination links using the render method-->
                    {{ $projects->render() }}
                </div>
            @else
                @include('projects.no-project-found')
            @endif
        </div>
        <!--/row-->
    </div>
    <!--/container -->
@endsection

