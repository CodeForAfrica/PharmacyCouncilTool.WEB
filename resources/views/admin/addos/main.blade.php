@extends('layouts.master')

@section('title')
    Administrator - Addos | Maduka ya Madawa - Code for Tanzania
@stop

@section('styles')
<link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
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
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{Session::get('message')}}
                </div>
            @endif
            <div class="col-md-12" style="overflow:auto;">
                <button type="button" class="btn btn-md btn-success no-radius pull-right" data-toggle="modal" data-target="#newAddoModal">NEW ADDO</button>
                <button type="button" class="btn btn-md btn-primary no-radius pull-right" data-toggle="modal" data-target="#importAddosModal" style="margin-right: 20px;">IMPORT ADDOS</button>
                <br />
                <hr />
                <br />
            </div><!-- close div .col-md-12 -->

            <table id="myTable" class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>FIN</th>
                    <th>Region</th>
                    <th>District</th>
                    <th>Ward</th>
                    <th>Owners</th>
                    <th style="width:130px;">Options</th>
                </tr>
                </thead>
            </table>
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
                        <form name="addos-form" method="post" action="{{ route('admin.addos.create') }}">
                            {{ csrf_field() }}
                            <div class="col-md-12">
                                <label>Name</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control no-radius" value="" placeholder="Name" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>FIN</label>
                                <div class="form-group">
                                    <input type="text" name="fin" class="form-control no-radius" value="" placeholder="FIN" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>Region</label>
                                <div class="form-group">
                                    <select id="region_id" name="region_id" class="form-control no-radius">
                                        <option value="0">Choose Region</option>
                                        @if(count($data['regions']) > 0)
                                            @foreach($data['regions'] as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>District</label>
                                <div class="form-group">
                                    <select id="district_id" name="district_id" class="form-control no-radius" disabled>
                                        <option value="0">Choose Region First</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>Ward</label>
                                <div class="form-group">
                                    <select id="ward_id" name="ward_id" class="form-control no-radius" disabled>
                                        <option value="0">Choose District First</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>Street</label>
                                <div class="form-group">
                                    <input type="text" name="street" class="form-control no-radius" value="" placeholder="Street" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="pull-left">Owner</label>
                                <button type="button" id="new-owner-btn" class="pull-right btn btn-primary btn-xs no-radius" style="font-size: 12px; font-weight: bold;">+ New Owner</button>
                                <div id="old-owner-div" class="form-group">
                                    <select id="owners_ids" name="owners_ids" class="form-control no-radius">
                                        <option value="0">Choose Addo Owner</option>
                                        @if(count($data['owners']) > 0)
                                            @foreach($data['owners'] as $owner)
                                                <option value="{{ $owner->id }}">{{ ucfirst(strtolower($owner->firstname)) }} {{ ucfirst(strtolower($owner->middlename)) }} {{ ucfirst(strtolower($owner->surname)) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div id="new-owner-div" class="new-owner" style="margin: 15px;">
                                <div class="col-md-12" style="margin-bottom:10px;">
                                    <button type="button" id="new-owner-div-close" class="close"><span aria-hidden="true">&times;</span></button> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="firstname" id="firstname" class="form-control no-radius" placeholder="Firstname" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="middlename" id="middlename" class="form-control no-radius" placeholder="Middlename" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="surname" id="surname" class="form-control no-radius" placeholder="Surname" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="phone" id="phone" class="form-control no-radius" placeholder="Phonenumber" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" class="form-control no-radius" placeholder="Email" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="status" id="status" class="form-control no-radius" placeholder="Status" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="button" id="add-new-owner-btn" class="btn btn-sm btn-success no-radius pull-right" value="ADD OWNER" />
                                    </div>
                                </div>
                            </div><!-- close div #new-owner -->

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="ADD ADDO" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- close div .modal-content -->
            </div>
        </div><!-- close div .modal -->

         <!-- Modal -->
         <div id="importAddosModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Import Addos</h4>
                    </div>
                    <div class="modal-body" style="overflow:auto;padding:20px;font-family: 'Roboto', sans-serif">
                        <div class="alert alert-info no-radius" role="alert">
                            <span class="fa fa-info-circle"></span>
                            The data file should be in <strong>CSV</strong> format, with semicolon <strong style="font-weight:bolder; font-size:18px;">:</strong> as the delimiter.
                        </div>

                        <form method="POST" action="{{ route('admin.addos.import') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-12">
                                <label>Upload File</label>
                                <div class="form-group">
                                    <input type="file" name="file" class="form-control-file" id="file">
                                </div>

                                <br />
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-pink no-radius pull-right">ADD ADDOS</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- close div .modal-content -->
            </div>
        </div><!-- close div .modal -->
    </div><!-- close div .container-fluid -->
@stop

@section('scripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('admin.addos.datatable') !!}',
                    "dataType": "json",
                    "type": "POST",
                    "data": { _token: "{{csrf_token()}}"}
                },
                columns: [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "fin" },
                    { "data": "region", "orderable": false },
                    { "data": "district", "orderable": false },
                    { "data": "ward", "orderable": false },
                    { "data": "owners", "orderable": false },
                    { "data": "options", "orderable": false}
                ]
            });
        });
    </script>

    <script>
        $('#new-owner-btn').click(function(){
            $('#new-owner-btn').hide();
            $('#old-owner-div').hide();
            $('#new-owner-div').slideToggle("slow");
        });

        $('#new-owner-div-close').click(function(){
            $('#new-owner-div').slideToggle("slow");
            $('#old-owner-div').slideToggle("slow");
            $('#new-owner-btn').slideToggle("slow");
        });

        $('#add-new-owner-btn').click(function(e){
            //var newOwnerForm = $('#new-owner-form');
            //e.preventDefault();
            //var formData = newOwnerForm.serialize();

            var formData = "firstname=" + $('#firstname').val() + "&middlename=" + $('#middlename').val() + "&surname=" + $('#surname').val() + 
                            "&phone=" + $('#phone').val() + "&email=" + $('#email').val() + "&status=" + $('#status').val();

            let type = "GET";
            let url =  "/admin/operations/addowner";

            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {

                    if(data.success){
                        //$('#owner-id').html("");
                        $('#owner_id').html(data.message);
                        $('#new-owner-div').slideToggle("slow");
                        $('#old-owner-div').slideToggle("slow");
                        $('#new-owner-btn').slideToggle("slow");
                    }
                    else{
                        //$("#error-message span").html(data.message);
                        //$("#error-message").show();
                    }
                },
                error: function (data) {
                    //$("#error-message span").html("Something went wrong, try to add new owner again.");
                    //$("#error-message").show();
                }
            });
        });

        $('#region_id').change(function(){
            // Disable District select
            $('#district_id').html("<option value='0'>Choose Region First</option>");
            $("#district_id").prop( "disabled", true);

            // Disable Ward select
            $('#ward_id').html("<option value='0'>Choose District First</option>");
            $("#ward_id").prop( "disabled", true);

            var formData = "region_id=" + $('#region_id').val();

            let type = "GET";
            let url =  "/admin/operations/getdistricts";

            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.success){
                        $('#district_id').html(data.message);
                        $("#district_id").prop( "disabled", false);
                    }
                    else{
                        //$("#error-message span").html(data.message);
                        //$("#error-message").show();
                    }
                },
                error: function (data) {
                    //$("#error-message span").html("Something went wrong, try to add new owner again.");
                    //$("#error-message").show();
                }
            });
        });

        $('#district_id').change(function(){
            // Disable Ward select
            $('#ward_id').html("<option value='0'>Choose District First</option>");
            $("#ward_id").prop( "disabled", true);

            var formData = "district_id=" + $('#district_id').val();

            let type = "GET";
            let url =  "/admin/operations/getwards";

            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {
                    console.log(data);
                    if(data.success){
                        $('#ward_id').html(data.message);
                        $("#ward_id").prop( "disabled", false);
                    }
                    else{
                        //$("#error-message span").html(data.message);
                        //$("#error-message").show();
                    }
                },
                error: function (data) {
                    //$("#error-message span").html("Something went wrong, try to add new owner again.");
                    //$("#error-message").show();
                }
            });
        });
    </script>
@stop