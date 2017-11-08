@extends('layouts.master')

@section('title')
    Administrator - Addos | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Addos</h1>
                    <h5 class="color-pink">Viewing an addo</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            <table class="table">
                <tr>
                    <th style="width:40%;">Name</th>
                    <td>{{ $data['addo']->name }}</td>
                </tr>
                <tr>
                    <th>Accreditation Number</th>
                    <td>{{ $data['addo']->accreditation_no }}</td>
                </tr>
                <tr>
                    <th>Region</th>
                    <td>{{ $data['addo']->region->name }}</td>
                </tr>
                <tr>
                    <th>District</th>
                    <td>{{ $data['addo']->district->name }}</td>
                </tr>
                <tr>
                    <th>Ward</th>
                    <td>{{ $data['addo']->ward->name }}</td>
                </tr>
                <tr>
                    <th>Street</th>
                    <td>{{ $data['addo']->street }}</td>
                </tr>
                <tr>
                    <th>Owner</th>
                    <td>{{ ucfirst(strtolower($data['addo']->owner->firstname)) }} {{ ucfirst(strtolower($data['addo']->owner->surname)) }}</td>
                </tr>
                <tr>
                    <th>Date Added</th>
                    <td>{{ $data['addo']->created_at }}</td>
                </tr>
            </table>

            <div class="pull-right">
                <a href="{{ route('admin.addos.delete',$data['addo']->id) }}" class="btn btn-md btn-danger no-radius" style="margin-right:10px;" disabled>Delete</a>
                <a href="{{ route('admin.addos.edit',$data['addo']->id) }}" type="button" class="btn btn-md btn-warning no-radius" style="margin-right:10px;">Edit</a>
            </div>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop