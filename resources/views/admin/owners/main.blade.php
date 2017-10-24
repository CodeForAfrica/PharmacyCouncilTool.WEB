@extends('layouts.master')

@section('title')
    Administrator - Owners | Maduka ya Madawa - Code for Tanzania
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
                    <h1>Owners</h1>
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
                <button type="button" class="btn btn-md btn-success no-radius pull-right" data-toggle="modal" data-target="#newOwnerModal">NEW OWNER</button>
                <br />
                <hr />
                <br />
            </div><!-- close div .col-md-12 -->

            @if ($data['owners'])
                <table id="myTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Middlename</th>
                        <th>Surname</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th style="width:130px;">Options</th>
                    </tr>
                    </thead>
                    <tbody style="text-align:left;">
                        <?php $n=1; ?>
                        @foreach($data['owners'] as $owner)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ ucfirst(strtolower($owner->firstname)) }}</td>
                            <td>{{ ucfirst(strtolower($owner->middlename)) }}</td>
                            <td>{{ ucfirst(strtolower($owner->surname)) }}</td>
                            <td>{{ $owner->phone }}</td>
                            <td>{{ $owner->email }}</td>
                            <td>
                                <a href="{{ route('admin.owners.delete',$owner->id) }}" class="btn btn-xs btn-danger no-radius" style="margin-right:10px;">Delete</a>
                                <a href="{{ route('admin.owners.edit',$owner->id) }}" type="button" class="btn btn-xs btn-warning no-radius" style="margin-right:10px;">Edit</a>
                                <a href="{{ route('admin.owners.view',$owner->id) }}" type="button" class="btn btn-xs btn-success no-radius">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h2>There is no any owner.</h2>
            @endif
        </div><!-- close div .admin-contents -->

        <!-- Modal -->
        <div id="newOwnerModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New Owner</h4>
                    </div>
                    <div class="modal-body" style="overflow:auto;padding:20px;font-family: 'Roboto', sans-serif">
                        <form method="post" action="{{ route('admin.owners.create') }}">
                            {{ csrf_field() }}

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

                            <label>Phonenumber</label>
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control no-radius" value="" placeholder="Phonenumber" />
                            </div>

                            <label>Email</label>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control no-radius" value="" placeholder="Email" />
                            </div>

                            <label>Status</label>
                            <div class="form-group">
                                <input type="text" name="status" class="form-control no-radius" value="" placeholder="Status" />
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="ADD OWNER" />
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