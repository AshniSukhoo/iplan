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
                        Dashboard
                    </div>

                    <div class="panel-body">
                        <div class="spark-settings-tabs">
                            <ul class="nav spark-settings-stacked-tabs" role="tablist">
                                <li role="presentation">
                                    <a href="{{ route('projects.index') }}">
                                        <i class="fa fa-file" aria-hidden="true"></i>
                                        My Projects
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="{{ route('projects.create') }}">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        Create new project
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="">
                                        <i class="fa fa-bell" aria-hidden="true"></i>
                                        Notification
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="">
                                       know know know whos
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="">
                                    taking you home home
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                </div>

                <div class="col-md-8">
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
