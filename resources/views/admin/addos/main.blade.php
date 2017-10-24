@extends('layouts.master')

@section('title')
    Administrator - Addos | Maduka ya Madawa - Code for Tanzania
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
                    <h1>Addos</h1>
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
                <button type="button" class="btn btn-md btn-success no-radius pull-right" data-toggle="modal" data-target="#newAddoModal">NEW ADDO</button>
                <br />
                <hr />
                <br />
            </div><!-- close div .col-md-12 -->

            @if ($data['addos'])
                <table id="myTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Accreditation No</th>
                        <th>Region</th>
                        <th>District</th>
                        <th>Ward</th>
                        <th>Owner Fullname</th>
                        <th>Owner Phonenumber</th>
                        <th style="width:130px;">Options</th>
                    </tr>
                    </thead>
                    <tbody style="text-align:left;">
                        <?php $n=1; ?>
                        @foreach($data['addos'] as $addo)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $addo->name }}</td>
                            <td>{{ $addo->accreditation_no }}</td>
                            <td>{{ $addo->region }}</td>
                            <td>{{ $addo->district }}</td>
                            <td>{{ $addo->ward }}</td>
                            <td>{{ ucfirst(strtolower($addo->owner->firstname)) }} {{ ucfirst(strtolower($addo->owner->middlename)) }} {{ ucfirst(strtolower($addo->owner->surname)) }}</td>
                            <td>{{ $addo->owner->phone }}</td>
                            <td>
                                <a href="{{ route('admin.addos.delete',$addo->id) }}" class="btn btn-xs btn-danger no-radius" style="margin-right:10px;">Delete</a>
                                <a href="{{ route('admin.addos.edit',$addo->id) }}" type="button" class="btn btn-xs btn-warning no-radius" style="margin-right:10px;">Edit</a>
                                <a href="{{ route('admin.addos.view',$addo->id) }}" type="button" class="btn btn-xs btn-success no-radius">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h2>There is no any Addo.</h2>
            @endif
        </div><!-- close div .admin-contents -->

        <!-- Modal -->
        <div id="newAddoModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New Addo</h4>
                    </div>
                    <div class="modal-body" style="overflow:auto;padding:20px;font-family: 'Roboto', sans-serif">
                        <form method="post" action="{{ route('admin.addos.create') }}">
                            {{ csrf_field() }}
                            <label>Name</label>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control no-radius" value="" placeholder="Name" />
                            </div>

                            <label>Accreditaition Number</label>
                            <div class="form-group">
                                <input type="text" name="accreditation_no" class="form-control no-radius" value="" placeholder="Accreditation Number" />
                            </div>

                            <label>Region</label>
                            <div class="form-group">
                                <input type="text" name="region" class="form-control no-radius" value="" placeholder="Region" />
                            </div>

                            <label>District</label>
                            <div class="form-group">
                                <input type="text" name="district" class="form-control no-radius" value="" placeholder="District" />
                            </div>

                            <label>Ward</label>
                            <div class="form-group">
                                <input type="text" name="ward" class="form-control no-radius" value="" placeholder="Ward" />
                            </div>

                            <label>Street</label>
                            <div class="form-group">
                                <input type="text" name="street" class="form-control no-radius" value="" placeholder="Street" />
                            </div>

                            <label>Owner</label>
                            <div class="form-group">
                                <select name="owner_id" class="form-control no-radius">
                                    <option value="0">Choose Addo Owner</option>
                                    @if(count($data['owners']) > 0)
                                        @foreach($data['owners'] as $owner)
                                            <option value="{{ $owner->id }}">{{ ucfirst(strtolower($owner->firstname)) }} {{ ucfirst(strtolower($owner->middlename)) }} {{ ucfirst(strtolower($owner->surname)) }} ({{ ucfirst(strtolower($owner->phone)) }})</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="ADD ADDO" />
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