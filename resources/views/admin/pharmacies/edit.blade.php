@extends('layouts.master')

@section('title')
    Administrator - Pharmacies | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Pharmacies</h1>
                    <h5 class="color-pink">Editing a pharmacy</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents" style="text-align:left;">
            @if(Session::has('message'))
                <div class="alert alert-{{Session::get('class')}}" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif
                    
            <form name="pharmacy-form" method="post" action="{{ route('admin.pharmacies.update') }}">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <label>FIN</label>
                    <div class="form-group">
                        <input type="text" name="fin" class="form-control no-radius" value="{{ $data['pharmacy']->fin }}" placeholder="FIN" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Registration Date</label>
                    <div class="form-group">
                        <input type="text" name="registration_date" class="form-control no-radius" value="{{ $data['pharmacy']->registration_date }}" placeholder="Registration Date" />
                    </div>
                </div>

                <div class="col-md-12">
                    <label>Name</label>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control no-radius" value="{{ $data['pharmacy']->name }}" placeholder="Name" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Category</label>
                    <div class="form-group">
                        <select name="category" class="form-control no-radius">
                            <option value="0" selected="selected">Choose Category</option>
                            <option value="Retail" @if($data['pharmacy']->category == "Retail") selected="selected" @endif>Retail</option>
                            <option value="Wholesale" @if($data['pharmacy']->category == "Wholesale") selected="selected" @endif>Wholesale</option>
                            <option value="Medical Device" @if($data['pharmacy']->category == "Medical Device") selected="selected" @endif>Medical Device</option>
                            <option value="ADDO" @if($data['pharmacy']->category == "ADDO") selected="selected" @endif>ADDO</option>
                            <option value="ARW" @if($data['pharmacy']->category == "ARW") selected="selected" @endif>ARW</option>
                            <option value="Warehouse" @if($data['pharmacy']->category == "Warehouse") selected="selected" @endif>Warehouse</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Country</label>
                    <div class="form-group">
                        <select name="country" class="form-control no-radius">
                            <option value="TANZANIA" selected="selected">TANZANIA</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <label>Region</label>
                    <div class="form-group">
                        <select id="region_id" name="region_id" class="form-control no-radius">
                            <option value="0">Choose Region</option>
                            @if(count($data['regions']) > 0)
                                @foreach($data['regions'] as $region)
                                    <option value="{{ $region->id }}" @if($data['pharmacy']->region_id == $region->id) selected="selected" @endif>{{ $region->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <label>District</label>
                    <div class="form-group">
                        <select id="district_id" name="district_id" class="form-control no-radius">
                            <option value="0">Choose District</option>
                            @if(count($data['districts']) > 0)
                                @foreach($data['districts'] as $district)
                                    <option value="{{ $district->id }}" @if($data['pharmacy']->district_id == $district->id) selected="selected" @endif>{{ $district->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <label>Ward</label>
                    <div class="form-group">
                        <select id="ward_id" name="ward_id" class="form-control no-radius">
                            <option value="0">Choose Ward</option>
                            @if(count($data['wards']) > 0)
                                @foreach($data['wards'] as $ward)
                                    <option value="{{ $ward->id }}" @if($data['pharmacy']->ward_id == $ward->id) selected="selected" @endif>{{ $ward->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Village</label>
                    <div class="form-group">
                        <input type="text" name="village" class="form-control no-radius" value="{{ $data['pharmacy']->village }}" placeholder="Village" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Village Code</label>
                    <div class="form-group">
                        <input type="text" name="village_code" class="form-control no-radius" value="{{ $data['pharmacy']->village_code }}" placeholder="Village Code" />
                    </div>
                </div>

                <div class="col-md-12">
                    <label>Physical</label>
                    <div class="form-group">
                        <input type="text" name="physical" class="form-control no-radius" value="{{ $data['pharmacy']->physical }}" placeholder="Physical" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div style="width:100%; overflow:auto;">
                        <label class="pull-left">Owner</label>
                        <button type="button" id="new-owner-btn" class="pull-right btn btn-primary btn-xs no-radius" style="font-size: 12px; font-weight: bold;">+ New Owner</button>
                    </div>
                    <div id="old-owner-div" class="form-group">
                        <select id="owners_ids" name="owners_ids" class="form-control no-radius">
                            <option value="0">Choose Premise Owner</option>
                            
                        </select>
                    </div>

                    <div id="new-owner-div" class="new-owner" style="margin: ;">
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
                </div>

                <div class="col-md-6">
                    <label>Postal Address</label>
                    <div class="form-group">
                        <input type="text" name="postal_address" class="form-control no-radius" value="{{ $data['pharmacy']->postal_address }}" placeholder="Postal Address" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Fax</label>
                    <div class="form-group">
                        <input type="text" name="fax" class="form-control no-radius" value="{{ $data['pharmacy']->fax }}" placeholder="Fax" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div style="width:100%; overflow:auto;">
                        <label class="pull-left">Pharmacist</label>
                        <button type="button" id="new-pharmacist-btn" class="pull-right btn btn-primary btn-xs no-radius" style="font-size: 12px; font-weight: bold;">+ New Pharmacist</button>
                    </div>
                    <div id="old-pharmacist-div" class="form-group">
                        <select id="pharmacist_id" name="pharmacist_id" class="form-control no-radius">
                            <option value="0">Choose Premise Pharmacist</option>
                            @if(count($data['personnels']) > 0)
                                @foreach($data['personnels'] as $personnel)
                                    <option value="{{ $personnel->id }}" @if($data['pharmacy']->pharmacist_id == $personnel->id) selected="selected" @endif>{{ ucfirst(strtolower($personnel->firstname)) }} {{ ucfirst(strtolower($personnel->middlename)) }} {{ ucfirst(strtolower($personnel->surname)) }} ({{ $personnel->type }})</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div id="new-pharmacist-div" class="new-owner" style="margin: ;">
                        <div class="col-md-12" style="margin-bottom:10px;">
                            <button type="button" id="new-pharmacist-div-close" class="close"><span aria-hidden="true">&times;</span></button> 
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <select id="pharmacist_type" name="type" class="form-control no-radius">
                                    <option value="0">Choose personnel category</option>
                                    <option value="Pharmacist">Pharmacist</option>
                                    <option value="Temporary Pharmacist">Temporary Pharmacist</option>
                                    <option value="Intern Pharmacist">Intern Pharmacist</option>
                                    <option value="Pharmaceutical Technician">Pharmaceutical Technician</option>
                                    <option value="Pharmaceutical Assistant">Pharmaceutical Assistant</option>
                                    <option value="Medical Representative">Medical Representative</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="firstname" id="pharmacist_firstname" class="form-control no-radius" placeholder="Firstname" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="middlename" id="pharmacist_middlename" class="form-control no-radius" placeholder="Middlename" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="surname" id="pharmacist_surname" class="form-control no-radius" placeholder="Surname" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="phone" id="pharmacist_phone" class="form-control no-radius" placeholder="Phonenumber" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="email" id="pharmacist_email" class="form-control no-radius" placeholder="Email" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="button" id="add-new-pharmacist-btn" class="btn btn-sm btn-success no-radius pull-right" value="ADD PHARMACIST" />
                            </div>
                        </div>
                    </div><!-- close div #new-pharmacist -->
                </div>

                <div class="col-md-6">
                    <div style="width:100%; overflow:auto;">
                        <label class="pull-left">Pharmaceutical Personnel</label>
                        <button type="button" id="new-pp-btn" class="pull-right btn btn-primary btn-xs no-radius" style="font-size: 12px; font-weight: bold;">+ New PP</button>
                    </div>
                    <div id="old-pp-div" class="form-group">
                        <select id="pp_id" name="pharmaceutical_personnel_id" class="form-control no-radius">
                            <option value="0">Choose Pharmaceutical Personnel</option>
                            @if(count($data['personnels']) > 0)
                                @foreach($data['personnels'] as $personnel)
                                    <option value="{{ $personnel->id }}" @if($data['pharmacy']->pharmaceutical_personnel_id == $personnel->id) selected="selected" @endif>{{ ucfirst(strtolower($personnel->firstname)) }} {{ ucfirst(strtolower($personnel->middlename)) }} {{ ucfirst(strtolower($personnel->surname)) }} ({{ $personnel->type }})</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div id="new-pp-div" class="new-owner" style="margin: ;">
                        <div class="col-md-12" style="margin-bottom:10px;">
                            <button type="button" id="new-pp-div-close" class="close"><span aria-hidden="true">&times;</span></button> 
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <select id="pp_type" name="type" class="form-control no-radius">
                                    <option value="0">Choose personnel category</option>
                                    <option value="Pharmacist">Pharmacist</option>
                                    <option value="Temporary Pharmacist">Temporary Pharmacist</option>
                                    <option value="Intern Pharmacist">Intern Pharmacist</option>
                                    <option value="Pharmaceutical Technician">Pharmaceutical Technician</option>
                                    <option value="Pharmaceutical Assistant">Pharmaceutical Assistant</option>
                                    <option value="Medical Representative">Medical Representative</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="firstname" id="pp_firstname" class="form-control no-radius" placeholder="Firstname" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="middlename" id="pp_middlename" class="form-control no-radius" placeholder="Middlename" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="surname" id="pp_surname" class="form-control no-radius" placeholder="Surname" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="phone" id="pp_phone" class="form-control no-radius" placeholder="Phonenumber" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="email" id="pp_email" class="form-control no-radius" placeholder="Email" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="button" id="add-new-pp-btn" class="btn btn-sm btn-success no-radius pull-right" value="ADD PERSONNEL" />
                            </div>
                        </div>
                    </div><!-- close div #new-pharmacist -->
                </div>

                <div class="col-md-6">
                    <label>Submitted Dispenser Contract</label>
                    <div class="form-group">
                        <select name="submitted_dispenser_contract" class="form-control no-radius">
                            <option value="0">Choose option</option>
                            <option value="Yes" @if($data['pharmacy']->submitted_dispenser_contract == "Yes") selected="selected" @endif>Yes</option>
                            <option value="No" @if($data['pharmacy']->submitted_dispenser_contract == "No") selected="selected" @endif>No</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Permit Profit Amount</label>
                    <div class="form-group">
                        <input type="text" name="permit_profit_amount" class="form-control no-radius" value="{{ $data['pharmacy']->permit_profit_amount }}" placeholder="Permit Profit Amount" />
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Receipt Number</label>
                    <div class="form-group">
                        <input type="text" name="receipt_no" class="form-control no-radius" value="{{ $data['pharmacy']->receipt_no }}" placeholder="Receipt Number" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Payment Date</label>
                    <div class="form-group">
                        <input type="text" name="payment_date" class="form-control no-radius" value="{{ $data['pharmacy']->payment_date }}" placeholder="Payment Date" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Remarks</label>
                    <div class="form-group">
                        <input type="text" name="remarks" class="form-control no-radius" value="{{ $data['pharmacy']->remarks }}" placeholder="Remarks" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Data Entry Date</label>
                    <div class="form-group">
                        <input type="text" name="data_entry_date" class="form-control no-radius" value="{{ $data['pharmacy']->data_entry_date }}" placeholder="Data Entry Date" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Premise Fees Due</label>
                    <div class="form-group">
                        <input type="text" name="premise_fees_due" class="form-control no-radius" value="{{ $data['pharmacy']->premise_fees_due }}" placeholder="Premise Fees Due" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Retention Due</label>
                    <div class="form-group">
                        <input type="text" name="retention_due" class="form-control no-radius" value="{{ $data['pharmacy']->retention_due }}" placeholder="Retention Due" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Renewal Status</label>
                    <div class="form-group">
                        <select name="renewal_status" class="form-control no-radius">
                            <option value="0">Choose Status</option>
                            <option value="Renewed" @if($data['pharmacy']->renewal_status == "Renewed") selected="selected" @endif>Renewed</option>
                            <option value="Pending" @if($data['pharmacy']->renewal_status == "Pending") selected="selected" @endif>Pending</option>
                            <option value="Waiting for Permit" @if($data['pharmacy']->renewal_status == "Waiting for Permit") selected="selected" @endif>Waiting for Permit</option>
                            <option value="Not Renewed" @if($data['pharmacy']->renewal_status == "Not Renewed") selected="selected" @endif>Not Renewed</option>
                            <option value="Closed" @if($data['pharmacy']->renewal_status == "Closed") selected="selected" @endif>Closed</option>
                            <option value="Temporary Closed"  @if($data['pharmacy']->renewal_status == "Temporary Closed") selected="selected" @endif>Temporary Closed</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Black Book List</label>
                    <div class="form-group">
                        <input type="text" name="black_book_list" class="form-control no-radius" value="{{ $data['pharmacy']->black_book_list }}" placeholder="Black Book List" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Extra Payment</label>
                    <div class="form-group">
                        <input type="text" name="extra_payment" class="form-control no-radius" value="{{ $data['pharmacy']->extra_payment }}" placeholder="Extra Payment" />
                    </div>
                </div>

                <input type="hidden" name="id" value="{{ $data['pharmacy']->id }}" />
                <div class="form-group">
                    <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="UPDATE PHARMACY" />
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

        $('#new-pharmacist-btn').click(function(){
            $('#new-pharmacist-btn').hide();
            $('#old-pharmacist-div').hide();
            $('#new-pharmacist-div').slideToggle("slow");
        });

        $('#new-pharmacist-div-close').click(function(){
            $('#new-pharmacist-div').slideToggle("slow");
            $('#old-pharmacist-div').slideToggle("slow");
            $('#new-pharmacist-btn').slideToggle("slow");
        });

        $('#add-new-pharmacist-btn').click(function(e){
            //var newOwnerForm = $('#new-owner-form');
            //e.preventDefault();
            //var formData = newOwnerForm.serialize();

            var formData = "type=" + $('#pharmacist_type').val() + "&firstname=" + $('#pharmacist_firstname').val() + 
                                "&middlename=" + $('#pharmacist_middlename').val() + "&surname=" + $('#pharmacist_surname').val() + 
                            "&phone=" + $('#pharmacist_phone').val() + "&email=" + $('#pharmacist_email').val();

            let type = "GET";
            let url =  "/admin/operations/addpersonnel";

            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {
                    if(data.success){
                        //$('#owner-id').html("");
                        $('#pharmacist_id').html(data.message);
                        $('#new-pharmacist-div').slideToggle("slow");
                        $('#old-pharmacist-div').slideToggle("slow");
                        $('#new-pharmacist-btn').slideToggle("slow");
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

        $('#new-pp-btn').click(function(){
            $('#new-pp-btn').hide();
            $('#old-pp-div').hide();
            $('#new-pp-div').slideToggle("slow");
        });

        $('#new-pp-div-close').click(function(){
            $('#new-pp-div').slideToggle("slow");
            $('#old-pp-div').slideToggle("slow");
            $('#new-pp-btn').slideToggle("slow");
        });

        $('#add-new-pp-btn').click(function(e){
            //var newOwnerForm = $('#new-owner-form');
            //e.preventDefault();
            //var formData = newOwnerForm.serialize();

            var formData = "type=" + $('#pp_type').val() + "&firstname=" + $('#pp_firstname').val() + 
                                "&middlename=" + $('#pp_middlename').val() + "&surname=" + $('#pp_surname').val() + 
                            "&phone=" + $('#pp_phone').val() + "&email=" + $('#pp_email').val();

            let type = "GET";
            let url =  "/admin/operations/addpersonnel";

            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {
                    if(data.success){
                        //$('#owner-id').html("");
                        $('#pp_id').html(data.message);
                        $('#new-pp-div').slideToggle("slow");
                        $('#old-pp-div').slideToggle("slow");
                        $('#new-pp-btn').slideToggle("slow");
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