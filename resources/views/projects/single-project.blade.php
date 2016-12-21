@extends('layouts.app')

@section('title')
    My project
@stop

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1> My project </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-5">
                <div class="card-wrapper">
                    <div class="card">
                        <p class="desc-text text-justify">
                            <b>Project id:</b>
                            {{ $projects->id}}
                        </p>

                        <p class="desc-text text-justify">
                            <b>Project name:</b>
                            {{ $projects->name}}
                        </p>

                        <p class="desc-text text-justify">
                            <b>Project name:</b>
                            {{ $projects->name}}
                        </p>

                        <p class="desc-text text-justify">
                           <b>Project description:</b>
                            {{ $projects->description}}
                        </p>

                        <p class="desc-text text-justify">
                            <b>Project created at:</b>
                            {{ $projects->created_at}}
                        </p>


                        <ul class="controls">

                            <li class="edit">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                <p class="text-a">Edit</p>
                            </li>

                            <li class="update">
                                <i class="fa fa-wrench" aria-hidden="true"></i>
                                <p class="text-a">Update</p>
                            </li>

                            <li class="trash">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                <p class="text-a">Delete</p>
                            </li>

                        </ul>
                    </div>
                </div>
             </div>
        </div>
    </div>
@endsection

