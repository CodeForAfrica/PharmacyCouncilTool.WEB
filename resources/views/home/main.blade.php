@extends('layouts.master')

@section('title')
    Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    @include('home.includes.jumbotron')

    @include('home.includes.kuhakiki')

    @include('home.includes.kuripoti')

    @include('home.includes.simuzamkononi')

    @include('home.includes.footer')
@stop