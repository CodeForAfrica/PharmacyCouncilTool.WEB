@extends('layouts.master')

@section('title')
    Administrator - Dispensers | Maduka ya Madawa - Code for Tanzania
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
                    <h1>Dispensers</h1>
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
                <button type="button" class="btn btn-md btn-success no-radius pull-right" data-toggle="modal" data-target="#newDispenserModal">NEW DISPENSER</button>
                <br />
                <hr />
                <br />
            </div><!-- close div .col-md-12 -->

            @if ($data['dispensers'])
                <table id="myTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>PIN</th>
                        <th>Fullname</th>
                        <th>Registration Date</th>
                        <th>Certificate No</th>
                        <th>Training Place</th>
                        <th style="width:130px;">Options</th>
                    </tr>
                    </thead>
                    <tbody style="text-align:left;">
                        <?php $n=1; ?>
                        @foreach($data['dispensers'] as $dispenser)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $dispenser->pin }}</td>
                            <td>{{ ucfirst(strtolower($dispenser->firstname)) }} {{ ucfirst(strtolower($dispenser->middlename)) }} {{ ucfirst(strtolower($dispenser->surname)) }}</td>
                            <td>{{ $dispenser->registration_date }}</td>
                            <td>{{ $dispenser->certificate_no }}</td>
                            <td>{{ $dispenser->training_place }}</td>
                            <td>
                                <a href="{{ route('admin.dispensers.delete',$dispenser->id) }}" class="btn btn-xs btn-danger no-radius" style="margin-right:10px;">Delete</a>
                                <a href="{{ route('admin.dispensers.edit',$dispenser->id) }}" type="button" class="btn btn-xs btn-warning no-radius" style="margin-right:10px;">Edit</a>
                                <a href="{{ route('admin.dispensers.view',$dispenser->id) }}" type="button" class="btn btn-xs btn-success no-radius">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h2>There is no any Dispenser.</h2>
            @endif
        </div><!-- close div .admin-contents -->

        <!-- Modal -->
        <div id="newDispenserModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New Dispenser</h4>
                    </div>
                    <div class="modal-body" style="overflow:auto;padding:20px;font-family: 'Roboto', sans-serif">
                        <form method="post" action="{{ route('admin.dispensers.create') }}">
                            {{ csrf_field() }}
                            <label>PIN</label>
                            <div class="form-group">
                                <input type="text" name="pin" class="form-control no-radius" value="" placeholder="PIN" />
                            </div>

                            <label>Firstname</label>
                            <div class="form-group">
                                <input type="text" name="firstname" class="form-control no-radius" value="" placeholder="Firstname" />
                            </div>

                            <label>Middlename</label>
                            <div class="form-group">
                                <input type="text" name="middlename" class="form-control no-radius" value="" placeholder="Middlename" />
                            </div>

                            <label>Surname</label>
                            <div class="form-group">
                                <input type="text" name="surname" class="form-control no-radius" value="" placeholder="Surname" />
                            </div>

                            <label>Registration Date</label>
                            <div class="form-group">
                                <input type="text" name="registration_date" class="form-control no-radius" value="" placeholder="Registration Date" />
                            </div>

                            <label>Birth Date</label>
                            <div class="form-group">
                                <input type="text" name="birth_date" class="form-control no-radius" value="" placeholder="Birth Date" />
                            </div>

                            <label>Sex</label>
                            <div class="form-group">
                                <input type="text" name="sex" class="form-control no-radius" value="" placeholder="Sex" />
                            </div>

                            <label>Phonenumber</label>
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control no-radius" value="" placeholder="Phonenumber" />
                            </div>

                            <label>Email</label>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control no-radius" value="" placeholder="Email" />
                            </div>

                            <label>Postal Address</label>
                            <div class="form-group">
                                <input type="text" name="postal_address" class="form-control no-radius" value="" placeholder="Postal Address" />
                            </div>

                            <label>Nationality</label>
                            <div class="form-group">
                                <input type="text" name="nationality" class="form-control no-radius" value="" placeholder="Nationality" />
                            </div>

                            <label>Certificate Number</label>
                            <div class="form-group">
                                <input type="text" name="certificate_no" class="form-control no-radius" value="" placeholder="Certificate Number" />
                            </div>

                            <label>Training Place</label>
                            <div class="form-group">
                                <input type="text" name="training_place" class="form-control no-radius" value="" placeholder="Training Place" />
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="ADD DISPENSER" />
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