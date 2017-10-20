@extends('layouts.master')

@section('title')
    Administrator - Users | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>users</h1>
                    <h5 class="color-pink">Editing a user</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents" style="text-align:left;">
            @if(Session::has('message'))
                <div class="alert alert-{{Session::get('class')}}" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif
                    
            <form method="post" action="{{ route('admin.users.update') }}">
                {{ csrf_field() }}

                <label>Name</label>
                <div class="form-group">
                    <input type="text" name="name" class="form-control no-radius" value="{{ $data['user']->name }}" placeholder="Fullname" />
                </div>

                <label>Email</label>
                <div class="form-group">
                    <input type="text" name="email" class="form-control no-radius" value="{{ $data['user']->email }}" placeholder="Email" />
                </div>

                <label>Date Added</label>
                <div class="form-group">
                    <input type="text" name="date_added" class="form-control no-radius" value="{{ $data['user']->created_at }}" placeholder="Date Added" disabled/>
                </div>

                <input type="hidden" name="id" value="{{ $data['user']->id }}" />
                <div class="form-group">
                    <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="UPDATE USER" />
                </div>
            </form>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop