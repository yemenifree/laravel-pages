@extends('gbrock.pages::app')

@section('content')
    <br>
    <form action="{{ action('PageTemplateController@postCreate') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('gbrock.pages::page_templates.form')
    </form>
@overwrite