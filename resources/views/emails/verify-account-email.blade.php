@extends('layouts.email-base')

@section('main-content')
    {!! Html::openEmailContentBlock() !!}
        Please confirm your email address by clicking the link below.
    {!! Html::closeEmailContentBlock() !!}

    {!! Html::openEmailContentBlock() !!}
        We may need to send you critical information about our service and it is
        important that we have an accurate email address.
    {!! Html::closeEmailContentBlock() !!}

    {!! Html::emailActionLink('Confirm email address', $verificationToken->url) !!}

    {!! Html::openEmailContentBlock() !!}
        &mdash; iPlan Team
    {!! Html::closeEmailContentBlock() !!}
@stop
