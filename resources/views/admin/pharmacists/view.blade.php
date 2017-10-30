@extends('layouts.master')

@section('title')
    Administrator - Pharmacists | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Pharmacists</h1>
                    <h5 class="color-pink">Viewing a pharmacist</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            <table class="table">
                <tr>
                    <th style="width:40%;">Firstname</th>
                    <td>{{ ucfirst(strtolower($data['pharmacist']->firstname)) }}</td>
                </tr>
                <tr>
                    <th>Middlename</th>
                    <td>{{ ucfirst(strtolower($data['pharmacist']->middlename)) }}</td>
                </tr>
                <tr>
                    <th>Surname</th>
                    <td>{{ ucfirst(strtolower($data['pharmacist']->surname)) }}</td>
                </tr>
                <tr>
                    <th>Level</th>
                    <td>{{ $data['pharmacist']->level }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $data['pharmacist']->phone }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $data['pharmacist']->email }}</td>
                </tr>
                <tr>
                    <th>Date Added</th>
                    <td>{{ $data['pharmacist']->created_at }}</td>
                </tr>
            </table>

            <div class="pull-right">
                <a href="{{ route('admin.pharmacists.delete',$data['pharmacist']->id) }}" class="btn btn-md btn-danger no-radius" style="margin-right:10px;" disabled>Delete</a>
                <a href="{{ route('admin.pharmacists.edit',$data['pharmacist']->id) }}" type="button" class="btn btn-md btn-warning no-radius" style="margin-right:10px;">Edit</a>
            </div>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop