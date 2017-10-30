@extends('layouts.master')

@section('title')
    Administrator - Owners | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Owners</h1>
                    <h5 class="color-pink">Viewing a owner</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            <table class="table">
                <tr>
                    <th style="width:40%;">Firstname</th>
                    <td>{{ ucfirst(strtolower($data['owner']->firstname)) }}</td>
                </tr>
                <tr>
                    <th>Middlename</th>
                    <td>{{ ucfirst(strtolower($data['owner']->middlename)) }}</td>
                </tr>
                <tr>
                    <th>Surname</th>
                    <td>{{ ucfirst(strtolower($data['owner']->surname)) }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $data['owner']->phone }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $data['owner']->email }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $data['owner']->status }}</td>
                </tr>
                <tr>
                    <th>Date Added</th>
                    <td>{{ $data['owner']->created_at }}</td>
                </tr>
            </table>

            <div class="pull-right">
                <a href="{{ route('admin.owners.delete',$data['owner']->id) }}" class="btn btn-md btn-danger no-radius" style="margin-right:10px;" disabled>Delete</a>
                <a href="{{ route('admin.owners.edit',$data['owner']->id) }}" type="button" class="btn btn-md btn-warning no-radius" style="margin-right:10px;">Edit</a>
            </div>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop