@extends('layouts.master')

@section('title')
    Administrator - Pharmacies | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Pharmacies</h1>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            @if ($data['pharmacies'])
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Registration Number</th>
                        <th>Name</th>
                        <th>Pharmacist</th>
                        <th>Location</th>
                        <th>Date Registered</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody style="text-align:left;">
                        <?php $n=1; ?>
                        @foreach($data['pharmacies'] as $pharmacy)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $pharmacy->registration_number }}</td>
                            <td>{{ $pharmacy->name }}</td>
                            <td>{{ $pharmacy->pharmacist }}</td>
                            <td>{{ $pharmacy->location }}</td>
                            <td>{{ $pharmacy->date_registered}}</td>
                            <td>
                                <button type="button" class="btn btn-xs btn-danger" disabled style="margin-right:10px;">Delete</button>
                                <button type="button" class="btn btn-xs btn-warning" disabled style="margin-right:10px;">Edit</button>
                                <button type="button" class="btn btn-xs btn-success" disabled>View</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h2>There is no any Pharmacy.</h2>
            @endif
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop