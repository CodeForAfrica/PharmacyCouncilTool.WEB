@extends('layouts.master')

@section('title')
    Administrator - Report | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Reports</h1>
                    <h5 class="color-pink">Viewing a report</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            <table class="table">
                <tr>
                    <th style="width:40%;">Gender</th>
                    <td>{{ $data['report']->gender }}</td>
                </tr>
                <tr>
                    <th>Pharmacy Registration Number</th>
                    <td>{{ $data['report']->pharmacy_registration_number }}</td>
                </tr>
                <tr>
                    <th>Message</th>
                    <td>{{ $data['report']->message }}</td>
                </tr>
                <tr>
                    <th>Date Received</th>
                    <td>{{ $data['report']->created_at }}</td>
                </tr>
            </table>

            <div class="pull-right">
                <a href="{{ route('admin.reports.delete',$data['report']->id) }}" class="btn btn-md btn-danger no-radius" style="margin-right:10px;">Delete</a>
                <a href="{{ route('admin.reports.edit',$data['report']->id) }}" type="button" class="btn btn-md btn-warning no-radius" style="margin-right:10px;" disabled>Edit</a>
            </div>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop