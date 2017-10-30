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
                    <input type="text" name="region" class="form-control no-radius" value="{{ $data['addo']->region }}" placeholder="Region" />
                </div>

                <label>District</label>
                <div class="form-group">
                    <input type="text" name="district" class="form-control no-radius" value="{{ $data['addo']->district }}" placeholder="District" />
                </div>

                <label>Ward</label>
                <div class="form-group">
                    <input type="text" name="ward" class="form-control no-radius" value="{{ $data['addo']->ward }}" placeholder="Ward" />
                </div>

                <label>Street</label>
                <div class="form-group">
                    <input type="text" name="street" class="form-control no-radius" value="{{ $data['addo']->street }}" placeholder="Street" />
                </div>

                <label>Owner</label>
                <div class="form-group">
                    <select name="owner_id" class="form-control no-radius">
                        <option value="0">Choose Addo Owner</option>
                        @if(count($data['owners']) > 0)
                            @foreach($data['owners'] as $owner)
                                <option value="{{ $owner->id }}" @if($data['addo']->owner_id == $owner->id) selected="selected" @endif>{{ ucfirst(strtolower($owner->firstname)) }} {{ ucfirst(strtolower($owner->middlename)) }} {{ ucfirst(strtolower($owner->surname)) }} ({{ ucfirst(strtolower($owner->phone)) }})</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <input type="hidden" name="id" value="{{ $data['addo']->id }}" />
                <div class="form-group">
                    <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="UPDATE ADDO" />
                </div>
            </form>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop