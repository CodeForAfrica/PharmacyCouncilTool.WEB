@extends('layouts.master')

@section('title')
    Administrator - Pharmacies | Maduka ya Madawa - Code for Tanzania
@stop

@section('styles')
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Pharmacies</h1>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            @if(Session::has('message'))
                <div class="alert alert-{{Session::get('class')}}" role="alert" style="text-align:left;">
                    {{Session::get('message')}}
                </div>
            @endif
            <div class="col-md-12" style="overflow:auto;">
                <button type="button" class="btn btn-md btn-success no-radius pull-right" data-toggle="modal" data-target="#newPharmacyModal">NEW PHARMACY</button>
                <br />
                <hr />
                <br />
            </div><!-- close div .col-md-12 -->

            @if ($data['pharmacies'])
                <table id="myTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Registration Number</th>
                        <th>Name</th>
                        <th>Pharmacist</th>
                        <th>Location</th>
                        <th>Date Registered</th>
                        <th style="width:130px;">Options</th>
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
                                <a href="{{ route('admin.pharmacies.delete',$pharmacy->id) }}" class="btn btn-xs btn-danger no-radius" style="margin-right:10px;">Delete</a>
                                <a href="{{ route('admin.pharmacies.edit',$pharmacy->id) }}" type="button" class="btn btn-xs btn-warning no-radius" style="margin-right:10px;">Edit</a>
                                <a href="{{ route('admin.pharmacies.view',$pharmacy->id) }}" type="button" class="btn btn-xs btn-success no-radius">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h2>There is no any Pharmacy.</h2>
            @endif
        </div><!-- close div .admin-contents -->

        <!-- Modal -->
        <div id="newPharmacyModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New Pharmacy</h4>
                    </div>
                    <div class="modal-body" style="overflow:auto;padding:20px;font-family: 'Roboto', sans-serif">
                        <form method="post" action="{{ route('admin.pharmacies.create') }}">
                            {{ csrf_field() }}
                            <label>Registration Number</label>
                            <div class="form-group">
                                <input type="text" name="registration_number" class="form-control no-radius" value="" placeholder="Pharmacy Registration Number" />
                            </div>

                            <label>Name</label>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control no-radius" value="" placeholder="Pharmacy Name" />
                            </div>

                            <label>Pharmacist</label>
                            <div class="form-group">
                                <input type="text" name="pharmacist" class="form-control no-radius" value="" placeholder="Pharmacist Name" />
                            </div>

                            <label>Address</label>
                            <div class="form-group">
                                <input type="text" name="address" class="form-control no-radius" value="" placeholder="Address" />
                            </div>

                            <label>Location</label>
                            <div class="form-group">
                                <input type="text" name="location" class="form-control no-radius" value="" placeholder="Location" />
                            </div>

                            <label>Date Registered</label>
                            <div class="form-group">
                                <input type="text" name="date_registered" class="form-control no-radius" value="" placeholder="Date Registered" />
                            </div>

                            <label>Ward</label>
                            <div class="form-group">
                                <input type="text" name="ward" class="form-control no-radius" value="" placeholder="Ward" />
                            </div>

                            <label>District</label>
                            <div class="form-group">
                                <input type="text" name="district" class="form-control no-radius" value="" placeholder="District" />
                            </div>

                            <label>Region</label>
                            <div class="form-group">
                                <input type="text" name="region" class="form-control no-radius" value="" placeholder="Region" />
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="ADD PHARMACY" />
                            </div>
                        </form>
                    </div>
                </div><!-- close div .modal-content -->
            </div>
        </div><!-- close div .modal -->
    </div><!-- close div .container-fluid -->
@stop

@section('scripts')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#myTable').DataTable();
        });
    </script>
@stop