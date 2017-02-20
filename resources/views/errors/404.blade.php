@extends('layouts.app')

@section('title')
   404 Error
@stop

@section('content')
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="margin-top: 50px; text-align: center">
                <div class="panel-heading">
                    <h3>
                        <i class="fa fa-warning"></i> Sorry, this content isn't available right now
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <p>
                                The link you followed may have expired, or the page may only be visible to an audience you're not in.
                            </p>
                            <a class="active" href="">Go back to previous page</a> .
                            <a class="active" href="{{ route('home') }}">Home Page</a> .
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.col-md-8 -->

    </div><!--/.row-->
@stop