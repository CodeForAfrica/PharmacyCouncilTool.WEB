@extends('layouts.master')

@section('title')
    Administrator - Dispensers | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Dispensers</h1>
                    <h5 class="color-pink">Viewing a dispenser</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            <table class="table">
                <tr>
                    <th style="width:40%;">PIN</th>
                    <td>{{ $data['dispenser']->pin }}</td>
                </tr>
                <tr>
                    <th>Firstname</th>
                    <td>{{ ucfirst(strtolower($data['dispenser']->firstname)) }}</td>
                </tr>
                <tr>
                    <th>Middlename</th>
                    <td>{{ ucfirst(strtolower($data['dispenser']->middlename)) }}</td>
                </tr>
                <tr>
                    <th>Surname</th>
                    <td>{{ ucfirst(strtolower($data['dispenser']->surname)) }}</td>
                </tr>
                <tr>
                    <th>Registration Date</th>
                    <td>{{ $data['dispenser']->registration_date }}</td>
                </tr>
                <tr>
                    <th>Birth Date</th>
                    <td>{{ $data['dispenser']->birth_date }}</td>
                </tr>
                <tr>
                    <th>Sex</th>
                    <td>{{ $data['dispenser']->sex }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $data['dispenser']->phone }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $data['dispenser']->email }}</td>
                </tr>
                <tr>
                    <th>Postal Address</th>
                    <td>{{ $data['dispenser']->postal_address }}</td>
                </tr>
                <tr>
                    <th>Nationality</th>
                    <td>{{ $data['dispenser']->nationality }}</td>
                </tr>
                <tr>
                    <th>Certficate Number</th>
                    <td>{{ $data['dispenser']->certificate_no }}</td>
                </tr>
                <tr>
                    <th>Training Place</th>
                    <td>{{ $data['dispenser']->training_place }}</td>
                </tr>
                <tr>
                    <th>Date Added</th>
                    <td>{{ $data['dispenser']->created_at }}</td>
                </tr>
            </table>

            <div class="pull-right">
                <a href="{{ route('admin.dispensers.delete',$data['dispenser']->id) }}" class="btn btn-md btn-danger no-radius" style="margin-right:10px;" disabled>Delete</a>
                <a href="{{ route('admin.dispensers.edit',$data['dispenser']->id) }}" type="button" class="btn btn-md btn-warning no-radius" style="margin-right:10px;">Edit</a>
            </div>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop