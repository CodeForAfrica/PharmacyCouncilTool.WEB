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
                    <h5 class="color-pink">Viewing a pharmacy</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            <table class="table">
                <tr>
                    <th style="width:40%;">FIN</th>
                    <td>{{ $data['pharmacy']->fin }}</td>
                </tr>
                <tr>
                    <th>Registration Date</th>
                    <td>{{ $data['pharmacy']->registration_date }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $data['pharmacy']->name }}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{ $data['pharmacy']->category }}</td>
                </tr>
                <tr>
                    <th>Category Code</th>
                    <td>{{ $data['pharmacy']->category_code }}</td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td>{{ $data['pharmacy']->country }}</td>
                </tr>
                <tr>
                    <th>Region</th>
                    <td>{{ $data['pharmacy']->region }}</td>
                </tr>
                <tr>
                    <th>Region Code</th>
                    <td>{{ $data['pharmacy']->region_code }}</td>
                </tr>
                <tr>
                    <th>District</th>
                    <td>{{ $data['pharmacy']->district }}</td>
                </tr>
                <tr>
                    <th>District Code</th>
                    <td>{{ $data['pharmacy']->district_code }}</td>
                </tr><tr>
                    <th>Ward</th>
                    <td>{{ $data['pharmacy']->ward }}</td>
                </tr>
                <tr>
                    <th>Ward Code</th>
                    <td>{{ $data['pharmacy']->ward_code }}</td>
                </tr><tr>
                    <th>Village</th>
                    <td>{{ $data['pharmacy']->village }}</td>
                </tr>
                <tr>
                    <th>Village Code</th>
                    <td>{{ $data['pharmacy']->village_code }}</td>
                </tr>
                <tr>
                    <th>Physical</th>
                    <td>{{ $data['pharmacy']->physical }}</td>
                </tr>
                <tr>
                    <th>Pharmacist</th>
                    <td>{{ ucfirst(strtolower($data['pharmacy']->pharmacist->firstname)) }} {{ ucfirst(strtolower($data['pharmacy']->pharmacist->surname)) }}</td>
                </tr>
                <tr>
                    <th>Owner</th>
                    <td>{{ ucfirst(strtolower($data['pharmacy']->owner->firstname)) }} {{ ucfirst(strtolower($data['pharmacy']->owner->surname)) }}</td>
                </tr>
                <tr>
                    <th>Postal Address</th>
                    <td>{{ $data['pharmacy']->physical }}</td>
                </tr>
                <tr>
                    <th>Fax</th>
                    <td>{{ $data['pharmacy']->fax }}</td>
                </tr>
                <tr>
                    <th>Submitted Dispenser Contract</th>
                    <td>{{ $data['pharmacy']->submitted_dispenser_contract }}</td>
                </tr>
                <tr>
                    <th>Permit Profit Amount</th>
                    <td>{{ $data['pharmacy']->permit_profit_amount }}</td>
                </tr>
                <tr>
                    <th>Receipt No</th>
                    <td>{{ $data['pharmacy']->receipt_no }}</td>
                </tr>
                <tr>
                    <th>Payment Date</th>
                    <td>{{ $data['pharmacy']->payment_date }}</td>
                </tr>
                <tr>
                    <th>Remarks</th>
                    <td>{{ $data['pharmacy']->remarks }}</td>
                </tr>
                <tr>
                    <th>Data Entry Date</th>
                    <td>{{ $data['pharmacy']->data_entry_date }}</td>
                </tr>
                <tr>
                    <th>Premise Fees Due</th>
                    <td>{{ $data['pharmacy']->premise_fees_due }}</td>
                </tr>
                <tr>
                    <th>Retention Due</th>
                    <td>{{ $data['pharmacy']->retention_due }}</td>
                </tr>
                <tr>
                    <th>Renewal Status</th>
                    <td>{{ $data['pharmacy']->renewal_status }}</td>
                </tr>
                <tr>
                    <th>Black Book List</th>
                    <td>{{ $data['pharmacy']->black_book_list }}</td>
                </tr>
                <tr>
                    <th>Extra Payment</th>
                    <td>{{ $data['pharmacy']->extra_payment }}</td>
                </tr>
                <tr>
                    <th>Date Added</th>
                    <td>{{ $data['pharmacy']->created_at }}</td>
                </tr>
            </table>

            <div class="pull-right">
                <a href="{{ route('admin.pharmacies.delete',$data['pharmacy']->id) }}" class="btn btn-md btn-danger no-radius" style="margin-right:10px;">Delete</a>
                <a href="{{ route('admin.pharmacies.edit',$data['pharmacy']->id) }}" type="button" class="btn btn-md btn-warning no-radius" style="margin-right:10px;">Edit</a>
            </div>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop