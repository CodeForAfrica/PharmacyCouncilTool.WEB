@extends('layouts.master')

@section('title')
    Administrator - Dispensers | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Dispensers</h1>
                    <h5 class="color-pink">Editing a dispenser</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents" style="text-align:left;">
            @if(Session::has('message'))
                <div class="alert alert-{{Session::get('class')}}" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif
                    
            <form method="post" action="{{ route('admin.dispensers.update') }}">
                {{ csrf_field() }}

                <label>PIN</label>
                <div class="form-group">
                    <input type="text" name="pin" class="form-control no-radius" value="{{ $data['dispenser']->pin }}" placeholder="PIN" />
                </div>

                <label>Firstname</label>
                <div class="form-group">
                    <input type="text" name="firstname" class="form-control no-radius" value="{{ $data['dispenser']->firstname }}" placeholder="Firstname" />
                </div>

                <label>Middlename</label>
                <div class="form-group">
                    <input type="text" name="middlename" class="form-control no-radius" value="{{ $data['dispenser']->middlename }}" placeholder="Middlename" />
                </div>

                <label>Surname</label>
                <div class="form-group">
                    <input type="text" name="surname" class="form-control no-radius" value="{{ $data['dispenser']->surname }}" placeholder="Surname" />
                </div>

                <label>Registration Date</label>
                <div class="form-group">
                    <input type="text" name="registration_date" class="form-control no-radius" value="{{ $data['dispenser']->registration_date }}" placeholder="Registration Date" />
                </div>

                <label>Birth Date</label>
                <div class="form-group">
                    <input type="text" name="birth_date" class="form-control no-radius" value="{{ $data['dispenser']->birth_date }}" placeholder="Birth Date" />
                </div>

                <label>Sex</label>
                <div class="form-group">
                    <input type="text" name="sex" class="form-control no-radius" value="{{ $data['dispenser']->sex }}" placeholder="Sex" />
                </div>

                <label>Phonenumber</label>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control no-radius" value="{{ $data['dispenser']->phone }}" placeholder="Phonenumber" />
                </div>

                <label>Email</label>
                <div class="form-group">
                    <input type="text" name="email" class="form-control no-radius" value="{{ $data['dispenser']->email }}" placeholder="Email" />
                </div>

                <label>Postal Address</label>
                <div class="form-group">
                    <input type="text" name="postal_address" class="form-control no-radius" value="{{ $data['dispenser']->postal_address }}" placeholder="Postal Address" />
                </div>

                <label>Nationality</label>
                <div class="form-group">
                    <input type="text" name="nationality" class="form-control no-radius" value="{{ $data['dispenser']->nationality }}" placeholder="Nationality" />
                </div>

                <label>Certificate Number</label>
                <div class="form-group">
                    <input type="text" name="certificate_no" class="form-control no-radius" value="{{ $data['dispenser']->certificate_no }}" placeholder="Certificate Number" />
                </div>

                <label>Training Place</label>
                <div class="form-group">
                    <input type="text" name="training_place" class="form-control no-radius" value="{{ $data['dispenser']->training_place }}" placeholder="Training Place" />
                </div>

                <input type="hidden" name="id" value="{{ $data['dispenser']->id }}" />
                <div class="form-group">
                    <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="UPDATE DISPENSER" />
                </div>
            </form>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop