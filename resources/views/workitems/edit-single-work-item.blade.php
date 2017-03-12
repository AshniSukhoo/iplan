@extends('layouts.app')

@section('title')
    Work Items-Edit Work Item
@stop

@section('css')
    <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">

        <form class="form-horizontal" role="form" method="POST"
              action="{{ route('work-items.update', ['project_id' => $project->id, 'id' => $workItem->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default panel-flush">

                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="work_item_estimated_time" class="control-label">Estimated time of
                                        work item (Hours)</label>
                                    <input id="work_item_estimated_time" type="number" class="form-control"
                                           name="work_item_estimated_time" value="{{ $workItem->estimated_time }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="work_item_status" class="control-label">Work Item Status</label>
                                    <select id="work_item_status" class="form-control" name="work_item_status">
                                        <option value="open" {{ $workItem->status == 'open' ? 'selected' : '' }}>
                                            Open
                                        </option>
                                        <option value="closed" {{ $workItem->status == 'closed' ? 'selected' : '' }}>
                                            Closed
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="work_item_type" class="control-label">Work item's type</label>
                                    <select id="work_item_type" name="work_item_type" class="form-control">
                                        <option value="Task" {{ $workItem->type == 'Task' ? 'selected' : '' }}>
                                            Task
                                        </option>
                                        <option value="Issue" {{ $workItem->type == 'Issue' ? 'selected' : '' }}>
                                            Issue
                                        </option>
                                        <option value="Features" {{ $workItem->type == 'Features' ? 'selected' : '' }}>
                                            Features
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="work_item_priority" class="control-label">Work item's
                                        priority</label>
                                    <select id="work_item_priority" name="work_item_priority"
                                            class="form-control">
                                        <option value="1" {{ $workItem->getOriginal('priority') == '1' ? 'selected' : '' }}>
                                            High
                                        </option>
                                        <option value="2" {{ $workItem->getOriginal('priority') == '2' ? 'selected' : '' }}>
                                            Medium
                                        </option>
                                        <option value="3" {{ $workItem->getOriginal('priority') == '3' ? 'selected' : '' }}>
                                            Low
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="work_item_assigned_user" class="control-label">Assign work item to
                                        member</label>
                                    <select id="work_item_assigned_user" name="work_item_assigned_user"
                                            class="form-control">
                                        <option value="" selected="selected">Type username...</option>
                                        @if(! is_null($workItem->assignedUser))
                                            <option value="{{ $workItem->assignedUser->id }}" selected="selected">
                                                {{ $workItem->assignedUser->full_name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="work_item_parent" class="control-label">Assign a parent work
                                        item</label>
                                    <select id="work_item_parent" name="work_item_parent" class="form-control">
                                        <option value="" selected="selected">Type work item title...</option>
                                        @if(! is_null($workItem->parentWorkItem))
                                            <option value="{{ $workItem->parentWorkItem->id }}" selected="selected">
                                                {{ $workItem->parentWorkItem->title }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--/.col-md-3-->

                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Editing Work item</h3>
                        </div>
                        <!--/.panel-heading-->

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

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="work_item_title" class="control-label">Work item's title</label>
                                    <input id="work_item_title" type="text" class="form-control"
                                           name="work_item_title" value="{{ $workItem->title }}" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="work_item_description" class="control-label">Work item's
                                        description</label>
                                    <textarea id="work_item_description" class="form-control"
                                              name="work_item_description">{{ $workItem->description }}</textarea>
                                </div>
                            </div>

                        </div>
                        <!--/.panel-body-->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-wrench" aria-hidden="true"></i>
                                        Save work item
                                    </button>
                                </div>

                                <div class="col-md-6">
                                    <a class="btn btn-warning btn-block"
                                       href="{{ route('work-items.show', ['project_id' => $project->id, 'id' => $workItem->id]) }}">
                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--/.panel-footer-->
                    </div>
                </div>
                <!--/.col-md-8-->
            </div>
        </form>
        <!--/.form-->
    </div>
    <!--/.container-->
@stop

@section('js')
    <script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#work_item_description').summernote({
                height: 300,
            });

            $("#work_item_assigned_user").select2({
                ajax: {
                    url: "{{ route('searchUserForProject', ['project' => $project->id]) }}",
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

            $("#work_item_parent").select2({
                ajax: {
                    url: "{{ route('searchParentWorkItem', ['project' => $project->id]) }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            parent: params.term
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
@endsection
