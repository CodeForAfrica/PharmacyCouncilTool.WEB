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
                <button type="button" class="btn btn-md btn-success no-radius pull-right" data-toggle="modal" data-target="#newAddoModal">NEW PHARMACY</button>
                <br />
                <hr />
                <br />
            </div><!-- close div .col-md-12 -->

            @if ($data['pharmacies'])
                <table id="myTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>FIN</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>District</th>
                        <th>Region</th>
                        <th>Pharmacist</th>
                        <th style="width:130px;">Options</th>
                    </tr>
                    </thead>
                    <tbody style="text-align:left;">
                        <?php $n=1; ?>
                        @foreach($data['pharmacies'] as $pharmacy)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $pharmacy->fin }}</td>
                            <td>{{ $pharmacy->name }}</td>
                            <td>{{ $pharmacy->category }}</td>
                            <td>{{ $pharmacy->district }}</td>
                            <td>{{ $pharmacy->region }}</td>
                            <td>{{ ucfirst(strtolower($pharmacy->pharmacist->firstname)) }} {{ ucfirst(strtolower($pharmacy->pharmacist->middlename)) }} {{ ucfirst(strtolower($pharmacy->pharmacist->surname)) }}</td>
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
        <div id="newAddoModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New Pharmacy</h4>
                    </div>
                    <div class="modal-body" style="overflow:auto;padding:20px;font-family: 'Roboto', sans-serif">
                        <form method="post" action="{{ route('admin.pharmacies.create') }}">
                            {{ csrf_field() }}
                            <div class="col-md-6">
                                <label>FIN</label>
                                <div class="form-group">
                                    <input type="text" name="fin" class="form-control no-radius" value="" placeholder="FIN" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Registration Date</label>
                                <div class="form-group">
                                    <input type="text" name="registration_date" class="form-control no-radius" value="" placeholder="Registration Date" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>Name</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control no-radius" value="" placeholder="Name" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Category</label>
                                <div class="form-group">
                                    <input type="text" name="category" class="form-control no-radius" value="" placeholder="Category" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Category Code</label>
                                <div class="form-group">
                                    <input type="text" name="category_code" class="form-control no-radius" value="" placeholder="Category Code" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>Country</label>
                                <div class="form-group">
                                    <input type="text" name="country" class="form-control no-radius" value="" placeholder="Country" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Region</label>
                                <div class="form-group">
                                    <input type="text" name="region" class="form-control no-radius" value="" placeholder="Region" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Region Code</label>
                                <div class="form-group">
                                    <input type="text" name="region_code" class="form-control no-radius" value="" placeholder="Region Code" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>District</label>
                                <div class="form-group">
                                    <input type="text" name="district" class="form-control no-radius" value="" placeholder="District" />
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>District Code</label>
                                <div class="form-group">
                                    <input type="text" name="district_code" class="form-control no-radius" value="" placeholder="District Code" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Ward</label>
                                <div class="form-group">
                                    <input type="text" name="ward" class="form-control no-radius" value="" placeholder="Ward" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Ward Code</label>
                                <div class="form-group">
                                    <input type="text" name="ward_code" class="form-control no-radius" value="" placeholder="Ward Code" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Village</label>
                                <div class="form-group">
                                    <input type="text" name="village" class="form-control no-radius" value="" placeholder="Village" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Village Code</label>
                                <div class="form-group">
                                    <input type="text" name="village_code" class="form-control no-radius" value="" placeholder="Village Code" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>Physical</label>
                                <div class="form-group">
                                    <input type="text" name="physical" class="form-control no-radius" value="" placeholder="Physical" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Owner</label>
                                <div class="form-group">
                                    <select name="owner_id" class="form-control no-radius">
                                        <option value="0">Choose Premise Owner</option>
                                        @if(count($data['owners']) > 0)
                                            @foreach($data['owners'] as $owner)
                                                <option value="{{ $owner->id }}">{{ ucfirst(strtolower($owner->firstname)) }} {{ ucfirst(strtolower($owner->middlename)) }} {{ ucfirst(strtolower($owner->surname)) }} ({{ ucfirst(strtolower($owner->phone)) }})</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Postal Address</label>
                                <div class="form-group">
                                    <input type="text" name="postal_address" class="form-control no-radius" value="" placeholder="Postal Address" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Fax</label>
                                <div class="form-group">
                                    <input type="text" name="fax" class="form-control no-radius" value="" placeholder="Fax" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Pharmacist</label>
                                <div class="form-group">
                                    <select name="pharmacist_id" class="form-control no-radius">
                                        <option value="0">Choose Premise Pharmacist</option>
                                        @if(count($data['pharmacists']) > 0)
                                            @foreach($data['pharmacists'] as $pharmacist)
                                                <option value="{{ $pharmacist->id }}">{{ ucfirst(strtolower($pharmacist->firstname)) }} {{ ucfirst(strtolower($pharmacist->middlename)) }} {{ ucfirst(strtolower($pharmacist->surname)) }} ({{ $pharmacist->level }})</option>
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
                                                <option value="{{ $pharmacist->id }}">{{ ucfirst(strtolower($pharmacist->firstname)) }} {{ ucfirst(strtolower($pharmacist->middlename)) }} {{ ucfirst(strtolower($pharmacist->surname)) }} ({{ $pharmacist->level }})</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Submitted Dispenser Contract</label>
                                <div class="form-group">
                                    <input type="text" name="submitted_dispenser_contract" class="form-control no-radius" value="" placeholder="Submitted Dispenser Contract" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Permit Profit Amount</label>
                                <div class="form-group">
                                    <input type="text" name="permit_profit_amount" class="form-control no-radius" value="" placeholder="Permit Profit Amount" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Receipt Number</label>
                                <div class="form-group">
                                    <input type="text" name="receipt_no" class="form-control no-radius" value="" placeholder="Receipt Number" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Payment Date</label>
                                <div class="form-group">
                                    <input type="text" name="payment_date" class="form-control no-radius" value="" placeholder="Payment Date" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Remarks</label>
                                <div class="form-group">
                                    <input type="text" name="remarks" class="form-control no-radius" value="" placeholder="Remarks" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Data Entry Date</label>
                                <div class="form-group">
                                    <input type="text" name="data_entry_date" class="form-control no-radius" value="" placeholder="Data Entry Date" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Premise Fees Due</label>
                                <div class="form-group">
                                    <input type="text" name="premise_fees_due" class="form-control no-radius" value="" placeholder="Premise Fees Due" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Retention Due</label>
                                <div class="form-group">
                                    <input type="text" name="retention_due" class="form-control no-radius" value="" placeholder="Retention Due" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Renewal Status</label>
                                <div class="form-group">
                                    <input type="text" name="renewal_status" class="form-control no-radius" value="" placeholder="Renewal Status" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Black Book List</label>
                                <div class="form-group">
                                    <input type="text" name="black_book_list" class="form-control no-radius" value="" placeholder="Black Book List" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Extra Payment</label>
                                <div class="form-group">
                                    <input type="text" name="extra_payment" class="form-control no-radius" value="" placeholder="Extra Payment" />
                                </div>
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