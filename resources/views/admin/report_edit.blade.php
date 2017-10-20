@extends('layouts.master')

@section('title')
    Administrator - Reports | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Reports</h1>
                    <h5 class="color-pink">Editing a report</h5>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents" style="text-align:left;">
            @if(Session::has('message'))
                <div class="alert alert-{{Session::get('class')}}" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif
                    
            <form method="post" action="{{ route('admin.reports.update') }}">
                {{ csrf_field() }}
                <label>Registration Number</label>
                <div class="form-group">
                    <select name="gender" class="form-control no-radius">
                        <option value="0">Choose gender</option>
                        <option value="Kiume" <?php if($data['report']->gender == "Kiume") echo 'selected="selected"'; ?>>Male</option>
                        <option value="Kike" <?php if($data['report']->gender == "Kike") echo 'selected="selected"'; ?>>Female</option>
                    </select>
                </div>

                <label>Location</label>
                <div class="form-group">
                    <input type="text" name="location" class="form-control no-radius" value="{{ $data['report']->location }}" placeholder="Location" />
                </div>

                <label>Message</label>
                <div class="form-group">
                    <textarea name="message" class="form-control no-radius" placeholder="Message">{{ $data['report']->message }}</textarea>
                </div>

                <label>Date Added</label>
                <div class="form-group">
                    <input type="text" name="date_added" class="form-control no-radius" value="{{ $data['report']->created_at }}" placeholder="Date Added" disabled/>
                </div>

                <input type="hidden" name="id" value="{{ $data['report']->id }}" />
                <div class="form-group">
                    <input type="submit" class="btn btn-lg btn-pink no-radius pull-right" value="UPDATE REPORT" />
                </div>
            </form>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop