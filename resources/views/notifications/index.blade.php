@extends('layouts.app')

@section('title')
    Notifications
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(!$notifications->isEmpty())
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @foreach($notifications as $notification)
                                <div class="row">
                                    <div class="col-md-1">
                                        <i class="{{ $notification->data['icon_class'] }} fa-2x" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-11">
                                        <a href="{{ $notification->data['link'] }}">
                                            {{ $notification->data['notification_text'] }}
                                        </a>
                                        <br>
                                        <abbr title="{{ $notification->created_at->toDayDateTimeString() }}">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </abbr>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <hr/>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <!--/.panel-->
                    @if($notifications->hasPages())
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <!--create the pagination links using the render method-->
                                {{ $notifications->render() }}
                            </div>
                        </div>
                        <!--/.row-->
                    @endif
                @else
                    @include('notifications.partials._no-notifications')
                @endif
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
@stop
