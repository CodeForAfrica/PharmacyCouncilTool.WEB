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
                    <h5 class="color-pink">Editing an addo</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents" style="text-align:left;">
            @if(Session::has('message'))
                <div class="alert alert-{{Session::get('class')}}" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{Session::get('message')}}
                </div>
            @endif
                    
            <form name="addo-form" method="post" action="{{ route('admin.addos.update') }}">
                {{ csrf_field() }}

                <label>Name</label>
                <div class="form-group">
                    <input type="text" name="name" class="form-control no-radius" value="{{ $data['addo']->name }}" placeholder="Name" />
                </div>

                <label>Accreditaition Number</label>
                <div class="form-group">
                    <input type="text" name="accreditation_no" class="form-control no-radius" value="{{ $data['addo']->accreditation_no }}" placeholder="Accreditation Number" />
                </div>

                <label>Region</label>
                <div class="form-group">
                    <select id="region_id" name="region_id" class="form-control no-radius">
                        <option value="0">Choose Region</option>
                        @if(count($data['regions']) > 0)
                            @foreach($data['regions'] as $region)
                                <option value="{{ $region->id }}" @if($data['addo']->region_id == $region->id) selected="selected" @endif>{{ $region->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <label>District</label>
                <div class="form-group">
                    <select id="district_id" name="district_id" class="form-control no-radius">
                        <option value="0">Choose District</option>
                        @if(count($data['districts']) > 0)
                            @foreach($data['districts'] as $district)
                                <option value="{{ $district->id }}" @if($data['addo']->district_id == $district->id) selected="selected" @endif>{{ $district->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <label>Ward</label>
                <div class="form-group">
                    <select id="ward_id" name="ward_id" class="form-control no-radius">
                        <option value="0">Choose Ward</option>
                        @if(count($data['wards']) > 0)
                            @foreach($data['wards'] as $ward)
                                <option value="{{ $ward->id }}" @if($data['addo']->ward_id == $ward->id) selected="selected" @endif>{{ $ward->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <label>Street</label>
                <div class="form-group">
                    <input type="text" name="street" class="form-control no-radius" value="{{ $data['addo']->street }}" placeholder="Street" />
                </div>

                <div style="width:100%; overflow:auto;">
                    <label class="pull-left">Owner</label>
                    <button type="button" id="new-owner-btn" class="pull-right btn btn-primary btn-xs no-radius" style="font-size: 12px; font-weight: bold;">+ New Owner</button>
                </div>
                
                <div id="old-owner-div" class="form-group">
                    <select id="owner_id" name="owner_id" class="form-control no-radius">
                        <option value="0">Choose Addo Owner</option>
                        @if(count($data['owners']) > 0)
                            @foreach($data['owners'] as $owner)
                                <option value="{{ $owner->id }}" @if($data['addo']->owner_id == $owner->id) selected="selected" @endif>{{ ucfirst(strtolower($owner->firstname)) }} {{ ucfirst(strtolower($owner->middlename)) }} {{ ucfirst(strtolower($owner->surname)) }} ({{ ucfirst(strtolower($owner->phone)) }})</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div id="new-owner-div" class="new-owner" style="margin:;">
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

                <input type="hidden" name="id" value="{{ $data['addo']->id }}" />
                <div class="form-group">
                    <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="UPDATE ADDO" />
                </div>
            </form>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop

@section('scripts')
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