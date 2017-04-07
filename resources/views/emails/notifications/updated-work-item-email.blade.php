@extends('layouts.email-base')

@section('main-content')
    {!! Html::openEmailContentBlock() !!}
    Hello {{ $workItem->assignedUser->full_name }},
    {!! Html::closeEmailContentBlock() !!}

    {!! Html::openEmailContentBlock() !!}
    {{  $user->full_name }} updated a work item on the project "{{ $project->name }}"
    {!! Html::closeEmailContentBlock() !!}

    {!! Html::emailActionLink('View Work Item on iPlan', $link) !!}

    {!! Html::openEmailContentBlock() !!}
    &mdash; iPlan Team
    {!! Html::closeEmailContentBlock() !!}
@stop
