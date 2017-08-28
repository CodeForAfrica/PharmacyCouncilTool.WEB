@extends('layouts.master')

@section('title')
    Administrator - Pharmacies | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Pharmacies</h1>
                    <h5 class="color-pink">Viewing a pharmacy</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            <table class="table">
                <tr>
                    <th style="width:40%;">Registration Number</th>
                    <td>{{ $data['pharmacy']->registration_number }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $data['pharmacy']->name }}</td>
                </tr>
                <tr>
                    <th>Pharmacist</th>
                    <td>{{ $data['pharmacy']->pharmacist }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $data['pharmacy']->address }}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>{{ $data['pharmacy']->location }}</td>
                </tr>
                <tr>
                    <th>Date Registered</th>
                    <td>{{ $data['pharmacy']->date_registered }}</td>
                </tr>
                <tr>
                    <th>Ward</th>
                    <td>{{ $data['pharmacy']->ward }}</td>
                </tr>
                <tr>
                    <th>District</th>
                    <td>{{ $data['pharmacy']->district }}</td>
                </tr>
                <tr>
                    <th>Region</th>
                    <td>{{ $data['pharmacy']->region }}</td>
                </tr>
                <tr>
                    <th>Date Added</th>
                    <td>{{ $data['pharmacy']->created_at }}</td>
                </tr>
            </table>

            <div class="pull-right">
                <a href="{{ route('admin.pharmacies.delete',$data['pharmacy']->id) }}" class="btn btn-md btn-danger no-radius" style="margin-right:10px;">Delete</a>
                <a href="{{ route('admin.pharmacies.edit',$data['pharmacy']->id) }}" type="button" class="btn btn-md btn-warning no-radius" style="margin-right:10px;">Edit</a>
            </div>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop