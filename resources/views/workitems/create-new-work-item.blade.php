@extends('layouts.app')

@section('title')
    Work Items-Create new work items
@stop

@section('css')
    <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">

        <form class="form-horizontal" role="form" method="POST"
              action=" {{ route('work-items.store', ['project_id'=>$project->id ]) }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default panel-flush">

                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="new_work_item_estimated_time" class="control-label">Estimated time of
                                        work item (Hours)</label>
                                    <input id="new_work_item_estimated_time" type="number" class="form-control"
                                           name="new_work_item_estimated_time">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="new_work_item_type" class="control-label">Work item's type</label>
                                    <select id="new_work_item_type" name="new_work_item_type" class="form-control">
                                        <option value="Task">
                                            Task
                                        </option>
                                        <option value="Issue">
                                            Issue
                                        </option>
                                        <option value="Features">
                                            Features
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="new_work_item_priority" class="control-label">Work item's
                                        priority</label>
                                    <select id="new_work_item_priority" name="new_work_item_priority"
                                            class="form-control">
                                        <option value="1">
                                            High
                                        </option>
                                        <option value="2">
                                            Medium
                                        </option>
                                        <option value="3">
                                            Low
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="new_work_item_assigned_user" class="control-label">Assign work item to member</label>
                                    <select id="new_work_item_assigned_user" name="new_work_item_assigned_user"
                                            class="form-control">
                                        <option value="" selected="selected">Type username...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="new_work_item_parent" class="control-label">Assign a parent work
                                        item</label>
                                    <select id="new_work_item_parent" name="new_work_item_parent" class="form-control">
                                        <option value="" selected="selected">Type work item title...</option>
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
                            <h3>Create new work item</h3>
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
                                    <label for="new_work_item_title" class="control-label">Work item's title</label>
                                    <input id="new_work_item_title" type="text" class="form-control"
                                           name="new_work_item_title" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="new_work_item_description" class="control-label">Work item's
                                        description</label>
                                    <textarea id="new_work_item_description" class="form-control"
                                              name="new_work_item_description"> </textarea>
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
                                    <a class="btn btn-warning btn-block" href="{{ route('home') }}">
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
            $('#new_work_item_description').summernote({
                height: 300,
            });

            $("#new_work_item_assigned_user").select2({
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
                minimumInputLength: 3,
            });

            $("#new_work_item_parent").select2();
        });
    </script>
@endsection