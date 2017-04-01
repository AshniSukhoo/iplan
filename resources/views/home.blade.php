@extends('layouts.app')

@section('title')
    Home
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('partials._home-page-widget', [
                    'widgetIcon' => 'fa fa-product-hunt',
                    'widgetNumber' => $numProjectsCreated,
                    'widgetText' => 'projects created',
                    'widgetLink' => route('projects.create'),
                    'widgetButtonClass' => 'btn btn-primary btn-flat btn-md',
                    'widgetButtonIcon' => 'fa fa-plus',
                    'widgetButtonText' => 'Create new'
                ])
            </div>
            <!--/.col-->

            <div class="col-sm-3">
                @include('partials._home-page-widget', [
                    'widgetIcon' => 'fa fa-file-o',
                    'widgetNumber' => $numAssignedProjects,
                    'widgetText' => 'assigned projects',
                    'widgetLink' => route('assignedProject'),
                    'widgetButtonClass' => 'btn btn-primary btn-flat btn-md',
                    'widgetButtonIcon' => 'fa fa-search',
                    'widgetButtonText' => 'View all'
                ])
            </div>
            <!--/.col-->

            <div class="col-sm-3">
                @include('partials._home-page-widget', [
                    'widgetIcon' => 'fa fa-tags',
                    'widgetNumber' => $numWorItemsToComplete,
                    'widgetText' => 'work items to complete',
                    'widgetLink' => '#',
                    'widgetButtonClass' => 'btn btn-primary btn-flat btn-md',
                    'widgetButtonIcon' => 'fa fa-search',
                    'widgetButtonText' => 'View all'
                ])
            </div>
            <!--/.col-->

            <div class="col-sm-3">
                @include('partials._home-page-widget', [
                    'widgetIcon' => 'fa fa-cog',
                    'widgetNumber' => $profilePercentageCompleted,
                    'widgetText' => 'profile completed',
                    'widgetLink' => route('profile.edit', ['user' => Auth::user()->id ]),
                    'widgetButtonClass' => 'btn btn-primary btn-flat btn-md',
                    'widgetButtonIcon' => 'fa fa-wrench',
                    'widgetButtonText' => 'Edit profile'
                ])
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <br>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recent Projects</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(!is_null($recentProjects) && !$recentProjects->isEmpty())
                            <ul class="products-list product-list-in-box">
                                @foreach($recentProjects as $project)
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="{{ $project->avatar }}" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('projects.show', ['project_id' => $project->id]) }}"
                                               class="product-title">
                                                {{ $project->name }}
                                                <span class="label label-warning pull-right">
                                                    {{ $project->percentageCompleted }}
                                                </span>
                                            </a>
                                            <span class="product-description">
                                                {{ str_limit(strip_tags($project->description),30,'...') }}
                                            </span>
                                        </div>
                                    </li>
                                    <!-- /.item -->
                                @endforeach
                            </ul>
                        @else
                            <div class="alert alert-info">
                                <h4><i class="icon fa fa-exclamation" aria-hidden="true"></i> Info</h4>
                                No recent projects.
                            </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="{{ route('projects.index') }}" class="uppercase">
                            View my projects
                        </a>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
            <!--/.col-->

            <div class="col-md-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recent Work items</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(!is_null($recentWorkItems) && ! $recentWorkItems->isEmpty())
                            <ul class="products-list product-list-in-box">
                                @foreach($recentWorkItems as $workItem)
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="{{ $workItem->avatar }}" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('work-items.show', ['project_id' => $workItem->project->id, 'id' => $workItem->id]) }}"
                                               class="product-title">
                                                {{ $workItem->title }}
                                            </a>
                                            <span class="product-description">
                                            {{ str_limit(strip_tags($workItem->description),30,'...') }}
                                        </span>
                                        </div>
                                    </li>
                                    <!-- /.item -->
                                @endforeach
                            </ul>
                        @else
                            <div class="alert alert-info">
                                <h4><i class="icon fa fa-exclamation" aria-hidden="true"></i> Info</h4>
                                No recent work items.
                            </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="#" class="uppercase">
                            View my work items
                        </a>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
@endsection
