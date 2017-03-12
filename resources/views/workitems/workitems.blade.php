@extends('layouts.app')

@section('title')
    Current Work Item list of {{ $project->name }}
@stop

@section('css')
    <link href="{{ asset('css/work-items.css') }}" rel="stylesheet">
@stop

@section('content')
    <
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked widget-table action-table">
                    <div class="page-header">
                        <h1>
                            Current Work Item list of {{ $project->name }}
                        </h1>
                    </div>
                    <div class="row">

                        <div class="span2 side-by-side clearfix">
                            <select id="Sort" class="form-control">
                                <option value="{{ route('work-items.index', ['project_id' => $project->id]) }}">Sort By</option>
                                <option value="{{ route('work-items.index', ['project_id' => $project->id, 'status' => 'open']) }}"
                                        {{ Request::has('status') && Request::input('status') == 'open' ? 'selected' : '' }}
                                        >
                                    Open
                                </option>
                                <option value="{{ route('work-items.index', ['project_id' => $project->id, 'status' => 'closed']) }}"
                                        {{ Request::has('status') && Request::input('status') == 'closed' ? 'selected' : '' }}
                                        >
                                    Closed
                                </option>
                            </select>
                        </div>
                        <div class="span3 side-by-side clearfix offset4">
                            <form action="#" method="get">
                                <div class="input-group">
                                    <input class="form-control" id="system-search" name="q" placeholder="Search for"
                                           required="">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-default" data-original-title="" title=""><i
                                                class="glyphicon glyphicon-search"></i></button>
								</span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br><br>
                    @if(! $workItems->isEmpty())

                        <div class="widget-content">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th id="">
                                        Title
                                    </th>
                                    <th id="">
                                        Type
                                    </th>
                                    <th id="">
                                        Priority
                                    </th>
                                    <th id="">
                                        Description
                                    </th>
                                    <th id="">
                                        Date Created
                                    </th>
                                    <th id="">
                                        Estimated time
                                    </th>
                                    <th id="">
                                        Status
                                    </th>
                                    <th class="td-actions" id="table_action">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($workItems as $workItem)
                                    <tr>
                                        <td>{{ $workItem->title }}</td>
                                        <td>{{ $workItem->type }}</td>
                                        <td>{{ $workItem->priority }}</td>
                                        <td>{!! str_limit(strip_tags($workItem->description),50,'...') !!}</td>
                                        <td>
                                            <abbr title="{{ $workItem->created_at->toDayDateTimeString() }}">
                                                {{ $workItem->created_at->diffForHumans()}}
                                            </abbr>
                                        </td>
                                        <td>{{ $workItem->estimated_time }} hour(s)</td>
                                        <td>{{ $workItem->status }}</td>

                                        <td class="td-actions">
                                            <a class="btn btn-default btn-xs"
                                               href="{{ route('work-items.edit', ['project_id' => $project->id, 'work-item_id' => $workItem->id ]) }}">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                                Edit
                                            </a>
                                            <a class="btn btn-default btn-xs" href="javascript:;">
                                                <span class="glyphicon glyphicon-remove"></span> Remove
                                            </a>
                                            <a class="btn btn-default btn-xs" href="{{ route('work-items.show', [
                                        'project_id' => $project->id,
                                        'work-item_id' => $workItem->id
                                      ]) }}">
                                                <span class="glyphicon glyphicon-search"></span> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /widget-content -->

                        @if($workItems->hasPages())
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <!--create the pagination links using the render method-->
                                    {{ $workItems->render() }}
                                </div>
                            </div>
                            <!--/.row-->
                        @endif
                </div>
                @else
                    <div class="col-md-12">
                        @include('workitems.no-work-item-found')
                    </div>
                    <!--/.col-->
                @endif
            </div>
        </div>
    </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function () {

            $('#Sort').on('change', function (e) {
                var url = $(this).val();
                window.location.href = url;
            });

        });
    </script>
@stop
