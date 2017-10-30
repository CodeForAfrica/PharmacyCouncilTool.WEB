@extends('layouts.master')

@section('title')
    Administrator - Owners | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Owners</h1>
                    <h5 class="color-pink">Editing a owner</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents" style="text-align:left;">
            @if(Session::has('message'))
                <div class="alert alert-{{Session::get('class')}}" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif
                    
            <form method="post" action="{{ route('admin.owners.update') }}">
                {{ csrf_field() }}

                <label>Firstname</label>
                <div class="form-group">
                    <input type="text" name="firstname" class="form-control no-radius" value="{{ $data['owner']->firstname }}" placeholder="Firstname" />
                </div>

                <label>Middlename</label>
                <div class="form-group">
                    <input type="text" name="middlename" class="form-control no-radius" value="{{ $data['owner']->middlename }}" placeholder="Middlename" />
                </div>

                <label>Surname</label>
                <div class="form-group">
                    <input type="text" name="surname" class="form-control no-radius" value="{{ $data['owner']->surname }}" placeholder="Surname" />
                </div>

                <label>Phonenumber</label>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control no-radius" value="{{ $data['owner']->phone }}" placeholder="Phonenumber" />
                </div>

                <label>Email</label>
                <div class="form-group">
                    <input type="text" name="email" class="form-control no-radius" value="{{ $data['owner']->email }}" placeholder="Email" />
                </div>

                <label>Status</label>
                <div class="form-group">
                    <input type="text" name="status" class="form-control no-radius" value="{{ $data['owner']->status }}" placeholder="Status" />
                </div>

                <input type="hidden" name="id" value="{{ $data['owner']->id }}" />
                <div class="form-group">
                    <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="UPDATE OWNER" />
                </div>
            </form>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop