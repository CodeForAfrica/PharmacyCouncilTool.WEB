@extends('layouts.master')

@section('title')
    Administrator - Personnel | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Personnel</h1>
                    <h5 class="color-pink">Viewing personnel</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            <table class="table">
                <tr>
                    <th>Category</th>
                    <td>{{ $data['personnel']->type }}</td>
                </tr>
                <tr>
                    <th style="width:40%;">Firstname</th>
                    <td>{{ ucfirst(strtolower($data['personnel']->firstname)) }}</td>
                </tr>
                <tr>
                    <th>Middlename</th>
                    <td>{{ ucfirst(strtolower($data['personnel']->middlename)) }}</td>
                </tr>
                <tr>
                    <th>Surname</th>
                    <td>{{ ucfirst(strtolower($data['personnel']->surname)) }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $data['personnel']->phone }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $data['personnel']->email }}</td>
                </tr>
                <tr>
                    <th>Date Added</th>
                    <td>{{ $data['personnel']->created_at }}</td>
                </tr>
            </table>

            <div class="pull-right">
                <a href="{{ route('admin.personnel.delete',$data['personnel']->id) }}" class="btn btn-md btn-danger no-radius" style="margin-right:10px;" disabled>Delete</a>
                <a href="{{ route('admin.personnel.edit',$data['personnel']->id) }}" type="button" class="btn btn-md btn-warning no-radius" style="margin-right:10px;">Edit</a>
            </div>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop