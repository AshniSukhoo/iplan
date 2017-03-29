@extends('layouts.app')

@section('title')
    Home
@stop

@section('content')
    <div class="container">
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
                                    <a href="{{ route('notifications') }}">
                                        <i class="fa fa-bell" aria-hidden="true"></i>
                                        Notifications
                                        @if(Auth::user()->unreadNotifications->count() > 0)
                                            <span class="badge" style="background-color: #bf5329">
                                                {{ Auth::user()->unreadNotifications->count() }}
                                            </span>
                                        @endif
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="{{ route('projects.index') }}">
                                        <i class="fa fa-file" aria-hidden="true"></i>
                                        My Projects
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="{{--{{ route('work-items.index', ['project_id'=>$project->id ]) }}--}}">
                                        <i class="fa fa-tasks" aria-hidden="true"></i>
                                        My Work Items
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

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
