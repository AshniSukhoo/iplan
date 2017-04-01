@extends('layouts.email-base')

@section('main-content')
    {!! Html::openEmailContentBlock() !!}
        Hello {{ $reciever->full_name }},
    {!! Html::closeEmailContentBlock() !!}

    {!! Html::openEmailContentBlock() !!}
        {{ $project->owner->full_name }} added you as a member to the project "{{ $project->name }}"
    {!! Html::closeEmailContentBlock() !!}

    {!! Html::emailActionLink('View Project on Iplan', $link) !!}

    {!! Html::openEmailContentBlock() !!}
        &mdash; iPlan Team
    {!! Html::closeEmailContentBlock() !!}
@stop
