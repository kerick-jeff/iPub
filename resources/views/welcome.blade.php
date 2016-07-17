@extends('layouts.master')

@section('title')

@section('description')
    <meta name="description" content = "describe iPub">
    <meta name="author" content = "name of author">
@endsection

@section('content')
    <div class="row" style = "margin-left: -70px">
        <img src="{{ asset('images/land1.jpg') }}" class="img-responsive" alt="landing_page photo" height="auto" max-width="100%">
    </div>
@endsection
