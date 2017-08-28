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
                    
            <form method="post" action="{{ route('admin.pharmacies.update') }}">
                {{ csrf_field() }}
                <label>Registration Number</label>
                <div class="form-group">
                    <input type="text" name="registration_number" class="form-control no-radius" value="{{ $data['pharmacy']->registration_number }}" placeholder="Pharmacy Registration Number" />
                </div>

                <label>Name</label>
                <div class="form-group">
                    <input type="text" name="name" class="form-control no-radius" value="{{ $data['pharmacy']->name }}" placeholder="Pharmacy Name" />
                </div>

                <label>Pharmacist</label>
                <div class="form-group">
                    <input type="text" name="pharmacist" class="form-control no-radius" value="{{ $data['pharmacy']->pharmacist }}" placeholder="Pharmacist Name" />
                </div>

                <label>Address</label>
                <div class="form-group">
                    <input type="text" name="address" class="form-control no-radius" value="{{ $data['pharmacy']->address }}" placeholder="Address" />
                </div>

                <label>Location</label>
                <div class="form-group">
                    <input type="text" name="location" class="form-control no-radius" value="{{ $data['pharmacy']->location }}" placeholder="Location" />
                </div>

                <label>Date Registered</label>
                <div class="form-group">
                    <input type="text" name="date_registered" class="form-control no-radius" value="{{ $data['pharmacy']->date_registered }}" placeholder="Date Registered" />
                </div>

                <label>Ward</label>
                <div class="form-group">
                    <input type="text" name="ward" class="form-control no-radius" value="{{ $data['pharmacy']->ward }}" placeholder="Ward" />
                </div>

                <label>District</label>
                <div class="form-group">
                    <input type="text" name="district" class="form-control no-radius" value="{{ $data['pharmacy']->district }}" placeholder="District" />
                </div>

                <label>Region</label>
                <div class="form-group">
                    <input type="text" name="region" class="form-control no-radius" value="{{ $data['pharmacy']->region }}" placeholder="Region" />
                </div>

                <label>Date Added</label>
                <div class="form-group">
                    <input type="text" name="date_added" class="form-control no-radius" value="{{ $data['pharmacy']->created_at }}" placeholder="Date Added" disabled/>
                </div>

                <input type="hidden" name="id" value="{{ $data['pharmacy']->id }}" />
                <div class="form-group">
                    <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="UPDATE PHARMACY" />
                </div>
            </form>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop