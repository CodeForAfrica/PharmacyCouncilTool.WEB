@extends('layouts.master')

@section('title')
    Administrator - Login | Maduka ya Madawa - Code for Tanzania
@stop

@section('styles')
    <style>
        body{
            background: #3e4395;
        }
    </style>
@stop

@section('content')
    <div class="container">
        <div class="row">   
            <div class="col-md-6 col-md-offset-3 login-box">
                <div class="brand">
                    <img src="{{ asset('images/pharmacy.png') }}" />
                    <h1>Maduka ya Dawa</h1>
                </div>

                <div class="login-form">
                    @if(Session::has('message'))
                        <div class="alert alert-{{Session::get('class')}}" role="alert">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form method="post" action="{{ route('admin.auth') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="email" class="form-control no-radius" value="{{ old('email') }}" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control no-radius" value="" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-lg btn-block btn-pink no-radius" value="LOGIN" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- close div .container -->
@stop