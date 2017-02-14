@extends('layouts.app')

@section('title')
    Work Items-Create new work items
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Create new work item</h1>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-3">
                @include('projects.sidebarmenu')
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">

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

                        <form class="form-horizontal" role="form" method="POST" action=" {{ route('work-items.store', ['project_id'=>$project->id ]) }}">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="new_work_item_title" class="control-label">Work item's title</label>
                                    <input id="new_work_item_title" type="text" class="form-control" name="new_work_item_title" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="work_item_description" class="control-label">Work item's description</label>
                                    <textarea id="new_work_item_description" class="form-control" name="new_work_item_description"> </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="new_work_item_estimated_time" class="control-label">Estimated time of work item</label>
                                    <input id="new_work_item_estimated_time" type="text" class="form-control" name="new_work_item_estimated_time">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="new_work_item_type" class="control-label">Work item's type</label>
                                    <select  list="types">
                                        <option value="Task"> Task </option>
                                        <option value="Issue"> Issue </option>
                                        <option value="Features"> Features </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="work_item_priority" class="control-label">Work item's priority</label>
                                    <select  list="types">
                                        <option value="high"> High </option>
                                        <option value="medium"> Medium </option>
                                        <option value="low"> Low </option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-wrench" aria-hidden="true"></i>
                                Save work item
                            </button>

                            <a class="btn btn-danger" href="{{ route('home') }}">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#new_work_item_description').summernote({
                height: 300,
            });
        });
    </script>

@endsection