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
                    <h1>Users</h1>
                    <h5 class="color-pink">Viewing a user</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            <table class="table">
                <tr>
                    <th style="width:40%;">Fullname</th>
                    <td>{{ $data['user']->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $data['user']->email }}</td>
                </tr>
                <tr>
                    <th>Date Added</th>
                    <td>{{ $data['user']->created_at }}</td>
                </tr>
            </table>

            <div class="pull-right">
                <a href="{{ route('admin.users.delete',$data['user']->id) }}" class="btn btn-md btn-danger no-radius" style="margin-right:10px;" disabled>Delete</a>
                <a href="{{ route('admin.users.edit',$data['user']->id) }}" type="button" class="btn btn-md btn-warning no-radius" style="margin-right:10px;">Edit</a>
            </div>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop