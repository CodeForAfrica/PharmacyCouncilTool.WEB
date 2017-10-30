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
                        <input type="text" name="category" class="form-control no-radius" value="{{ $data['pharmacy']->category }}" placeholder="Category" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Category Code</label>
                    <div class="form-group">
                        <input type="text" name="category_code" class="form-control no-radius" value="{{ $data['pharmacy']->category_code }}" placeholder="Category Code" />
                    </div>
                </div>

                <div class="col-md-12">
                    <label>Country</label>
                    <div class="form-group">
                        <input type="text" name="country" class="form-control no-radius" value="{{ $data['pharmacy']->country }}" placeholder="Country" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Region</label>
                    <div class="form-group">
                        <input type="text" name="region" class="form-control no-radius" value="{{ $data['pharmacy']->region }}" placeholder="Region" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Region Code</label>
                    <div class="form-group">
                        <input type="text" name="region_code" class="form-control no-radius" value="{{ $data['pharmacy']->region_code }}" placeholder="Region Code" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>District</label>
                    <div class="form-group">
                        <input type="text" name="district" class="form-control no-radius" value="{{ $data['pharmacy']->district }}" placeholder="District" />
                    </div>
                </div>
                
                <div class="col-md-6">
                    <label>District Code</label>
                    <div class="form-group">
                        <input type="text" name="district_code" class="form-control no-radius" value="{{ $data['pharmacy']->district_code }}" placeholder="District Code" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Ward</label>
                    <div class="form-group">
                        <input type="text" name="ward" class="form-control no-radius" value="{{ $data['pharmacy']->ward }}" placeholder="Ward" />
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Ward Code</label>
                    <div class="form-group">
                        <input type="text" name="ward_code" class="form-control no-radius" value="{{ $data['pharmacy']->ward_code }}" placeholder="Ward Code" />
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
                    <label>Owner</label>
                    <div class="form-group">
                        <select name="owner_id" class="form-control no-radius">
                            <option value="0">Choose Premise Owner</option>
                            @if(count($data['owners']) > 0)
                                @foreach($data['owners'] as $owner)
                                    <option value="{{ $owner->id }}" @if($data['pharmacy']->owner_id == $owner->id) selected="selected" @endif>{{ ucfirst(strtolower($owner->firstname)) }} {{ ucfirst(strtolower($owner->middlename)) }} {{ ucfirst(strtolower($owner->surname)) }} ({{ ucfirst(strtolower($owner->phone)) }})</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
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
                    <label>Pharmacist</label>
                    <div class="form-group">
                        <select name="pharmacist_id" class="form-control no-radius">
                            <option value="0">Choose Premise Pharmacist</option>
                            @if(count($data['pharmacists']) > 0)
                                @foreach($data['pharmacists'] as $pharmacist)
                                    <option value="{{ $pharmacist->id }}" @if($data['pharmacy']->pharmacist_id == $pharmacist->id) selected="selected" @endif>{{ ucfirst(strtolower($pharmacist->firstname)) }} {{ ucfirst(strtolower($pharmacist->middlename)) }} {{ ucfirst(strtolower($pharmacist->surname)) }} ({{ $pharmacist->level }})</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Pharmaceutical Personnel</label>
                    <div class="form-group">
                        <select name="pharmaceutical_personnel_id" class="form-control no-radius">
                            <option value="0">Choose Pharmaceutical Personnel</option>
                            @if(count($data['pharmacists']) > 0)
                                @foreach($data['pharmacists'] as $pharmacist)
                                    <option value="{{ $pharmacist->id }}" @if($data['pharmacy']->pharmaceutical_personnel_id == $pharmacist->id) selected="selected" @endif>{{ ucfirst(strtolower($pharmacist->firstname)) }} {{ ucfirst(strtolower($pharmacist->middlename)) }} {{ ucfirst(strtolower($pharmacist->surname)) }} ({{ $pharmacist->level }})</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Submitted Dispenser Contract</label>
                    <div class="form-group">
                        <input type="text" name="submitted_dispenser_contract" class="form-control no-radius" value="{{ $data['pharmacy']->submitted_dispenser_contract }}" placeholder="Submitted Dispenser Contract" />
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
                        <input type="text" name="renewal_status" class="form-control no-radius" value="{{ $data['pharmacy']->renewal_status }}" placeholder="Renewal Status" />
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