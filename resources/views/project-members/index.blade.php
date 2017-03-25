@extends('layouts.app')

@section('title')
    Members of {{ $project->name }}
@stop

@section('css')
    <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 style="text-align: center">
                    Members of "{{ $project->name }}"
                </h3>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="panel panel-default panel-flush">

                    <div class="panel-heading">
                        Info <i class="fa fa-info-circle" aria-hidden="true"></i>
                    </div>

                    <div class="panel-body">
                        <div class="spark-settings-tabs">
                            <ul class="nav spark-settings-stacked-tabs" role="tablist">
                                <li role="presentation">
                                    <a href="">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                        Owner: {{ $project->owner->id == Auth::user()->id ? 'You' : $project->owner->first_name }}
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="#">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                        @if($members->total() == 0)
                                            No members for this project
                                        @else
                                            {{ $members->total() }} collaborators
                                        @endif
                                    </a>
                                </li>
                            </ul>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <a href="{{ route('projects.show', ['project_id' => $project->id]) }}"
                                       class="btn btn-primary btn-block">
                                        <i class="fa fa-file" aria-hidden="true"></i> Back to Project
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--/.nav-->
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-md-9 col-sm-9 col-xs-12">

                @can('modify', $project)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Search and add a member to your project.
                        </h3>
                    </div>
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

                        @if(session('success_message'))
                            <div class="alert alert-success">
                                {{ session('success_message') }}
                            </div>
                        @endif
                        <form class="form-horizontal" action="{{ route('members.store', ['project' => $project->id]) }}"
                              method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-10">
                                    <select id="project_member" name="project_member" class="form-control">
                                        <option value="" selected="selected">Type username...</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-block btn-sm">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endcan

                @if(! $members->isEmpty())

                    @foreach($members->chunk(3) as $memberRow)
                        <div class="row form-group">
                            @foreach($memberRow as $member)
                                <div class="col-sm-4">
                                    @include('users.partials._profile-card', [
                                        'user' => $member,
                                        'actionTemplate' => 'project-members.partials._members-actions',
                                        'actionData' => ['project' => $project, 'user' => $member]
                                    ])
                                </div>
                            @endforeach
                        </div>
                        <!--/.row-->
                    @endforeach

                    @if($members->hasPages())
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <!--create the pagination links using the render method-->
                                {{ $members->render() }}
                            </div>
                        </div>
                        <!--/.row-->
                    @endif
                @else
                    @include('project-members.partials._no-members', ['project' => $project])
                @endif
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
@stop

@section('js')
    <script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#project_member").select2({
                ajax: {
                    url: "{{ route('searchNonUserForProject', ['project' => $project->id]) }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            name: params.term
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data.items
                        };
                    },
                    cache: true
                },
                minimumInputLength: 3
            });
        });
    </script>
@stop