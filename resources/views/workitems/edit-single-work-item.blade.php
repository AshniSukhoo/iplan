@extends('layouts.app')

@section('title')
    Work Items-Edit work items
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ $workitem->title}}</h1>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-3">
                {{--@include('workitems.sidebarmenu')--}}
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

                        <form class="form-horizontal" role="form" method="POST" action=" {{ route('work-items.update', ['project_id'=>$project->id ]) }}">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="work_item_title" class="control-label">{{$workitem->title}}</label>
                                    <input id="work_item_title" type="text" class="form-control" name="work_item_title" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="work_item_description" class="control-label">{{$workitem->description}}</label>
                                    <textarea id="work_item_description" class="form-control" name="work_item_description"> </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="work_item_estimated_time" class="control-label">{{$workitem->estimated_time}}</label>
                                    <input id="work_item_estimated_time" type="text" class="form-control" name="work_item_estimated_time">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="work_item_type" class="control-label">{{$workitem->type}}</label>
                                </div>

                                <div class="col-md-6">
                                    <label for="work_item_priority" class="control-label">{{$workitem->priority}}</label>
                                </div>
                            </div>
                            <br>

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-wrench" aria-hidden="true"></i>
                                Update project
                            </button>

                            <a class="btn btn-danger" href="{{ route('workitem.show', ['id' => $project->id]) }}">
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