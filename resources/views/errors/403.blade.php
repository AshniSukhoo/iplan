@extends('layouts.app')

@section('title')
    403 Error
@stop

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
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
                                    Sorry you do not have access to this content.
                                </p>
                                <a class="active" href="{{ session()->has('_previous') ? session()->has('_previous')['url'] : route('home') }}">
                                    Go back to previous page
                                </a> .
                                <a class="active" href="{{ route('home') }}">
                                    Home Page
                                </a> .
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.col-md-8 -->

        </div><!--/.row-->
    </div>
    <!--/.container-->
@stop
