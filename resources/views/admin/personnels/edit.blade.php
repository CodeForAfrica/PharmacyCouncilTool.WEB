@extends('layouts.master')

@section('title')
    Administrator - Personnel | Pharmacy Council - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Personnel</h1>
                    <h5 class="color-pink">Editing personnel</h5>
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
                    
            <form name="personnel-form" method="post" action="{{ route('admin.personnel.update') }}">
                {{ csrf_field() }}

                <label>Category</label>
                <div class="form-group">
                    <select name="type" class="form-control no-radius">
                        <option value="0">Choose personnel category</option>
                        <option value="Pharmacist" @if($data['personnel']->type == "Pharmacist") selected="selected" @endif>Pharmacist</option>
                        <option value="Temporary Pharmacist" @if($data['personnel']->type == "Temporary Pharmacist") selected="selected" @endif>Temporary Pharmacist</option>
                        <option value="intern Pharmacist" @if($data['personnel']->type == "Intern Pharmacist") selected="selected" @endif>Intern Pharmacist</option>
                        <option value="Pharmaceutical Technician" @if($data['personnel']->type == "Pharmaceutical Technician") selected="selected" @endif>Pharmaceutical Technician</option>
                        <option value="Pharmaceutical Assistant" @if($data['personnel']->type == "Pharmaceutical Assistant") selected="selected" @endif>Pharmaceutical Assistant</option>
                        <option value="Medical Representative" @if($data['personnel']->type == "Medical Representative") selected="selected" @endif>Medical Representative</option>
                    </select>
                </div>

                <label>Firstname</label>
                <div class="form-group">
                    <input type="text" name="firstname" class="form-control no-radius" value="{{ $data['personnel']->firstname }}" placeholder="Firstname" />
                </div>

                <label>Middlename</label>
                <div class="form-group">
                    <input type="text" name="middlename" class="form-control no-radius" value="{{ $data['personnel']->middlename }}" placeholder="Middlename" />
                </div>

                <label>Surname</label>
                <div class="form-group">
                    <input type="text" name="surname" class="form-control no-radius" value="{{ $data['personnel']->surname }}" placeholder="Surname" />
                </div>

                <label>Phonenumber</label>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control no-radius" value="{{ $data['personnel']->phone }}" placeholder="Phonenumber" />
                </div>

                <label>Email</label>
                <div class="form-group">
                    <input type="text" name="email" class="form-control no-radius" value="{{ $data['personnel']->email }}" placeholder="Email" />
                </div>

                <input type="hidden" name="id" value="{{ $data['personnel']->id }}" />
                <div class="form-group">
                    <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="UPDATE PERSONNEL" />
                </div>
            </form>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop