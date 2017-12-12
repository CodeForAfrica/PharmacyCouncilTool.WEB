@extends('layouts.master')

@section('title')
    Administrator - Dashboard | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            <div class="row">
                <div class="col-md-3">
                    <div class="well" style="height:262px;">
                        <h1 class="color-pink">{{ count($data['dispensers']) }}</h1>
                        <h2><a href="{{ route('admin.dispensers') }}">Dispensers</a></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well" style="height:262px;">
                        <h1 class="color-pink">{{ count($data['addos']) }}</h1>
                        <h2><a href="{{ route('admin.addos') }}">Addos</a></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well">
                        <h1 class="color-pink">{{ count(null) }}</h1>
                        <h3><a href="{{ route('admin.personnel') }}">Personnels</a></h3>
                        <hr />
                        <div style="text-align:left; overflow:auto; width:100%;">
                            <span class="pull-left"><a href="{{ route('admin.personnel') }}?type=Pharmacist">Pharmacists - <strong>{{ count(null) }}</strong></a></span>
                        </div>
                        <div style="text-align:left; overflow:auto; width:100%">
                            <span class="pull-left"><a href="{{ route('admin.personnel') }}?type=Pharmaceutical Technician">Pharmaceutical Technicians - <strong>{{ count(null) }}</strong></a></span>
                        </div>
                        <div style="text-align:left; overflow:auto; width:100%">
                            <span class="pull-left"><a href="{{ route('admin.personnel') }}?type=Medical Representative">Medical Representatives - <strong>{{ count($data['personnels_medical_representatives']) }}</strong></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well">
                        <h1 class="color-pink">{{ count($data['pharmacies']) }}</h1>
                        <h3><a href="{{ route('admin.pharmacies') }}">Pharmacies</a></h3>
                        <hr />
                        <div style="text-align:left; overflow:auto; width:100%;">
                            <span class="pull-left"><a href="{{ route('admin.pharmacies') }}?status=Renewed">Renewed - <strong>{{ count($data['pharmacies_renewed']) }}</strong></a></span>
                            <span class="pull-right"><a href="{{ route('admin.pharmacies') }}?status=Not Renewed">Not Renewed - <strong>{{ count($data['pharmacies_not_renewed']) }}</strong></a></span>
                        </div>
                        <div style="text-align:left; overflow:auto; width:100%">
                            <span class="pull-left"><a href="{{ route('admin.pharmacies') }}?status=Pending">Pending - <strong>{{ count($data['pharmacies_pending']) }}</strong></a></span>
                            <span class="pull-right"><a href="{{ route('admin.pharmacies') }}?status=Waiting Permit">Waiting Permit - <strong>{{ count($data['pharmacies_waiting_permit']) }}</strong></a></span>
                        </div>
                        <div style="text-align:left; overflow:auto; width:100%">
                            <span class="pull-left"><a href="{{ route('admin.pharmacies') }}?status=Closed">Closed - <strong>{{ count($data['pharmacies_closed']) }}</strong></a></span>
                            <span class="pull-right"><a href="{{ route('admin.pharmacies') }}?status">Temporary Closed - <strong>{{ count($data['pharmacies_temporary_closed']) }}</strong></a></span>
                        </div>
                    </div>
                </div>
            </div><!-- close div .row -->
            <hr />
            <br />
            <div class="row">
                <div class="col-md-3">
                    <div class="well" style="height:262px;">
                        <h1 class="color-pink">{{ count($data['owners']) }}</h1>
                        <h3><a href="{{ route('admin.owners') }}">Owners</a></h3>
                        <hr />
                        <div style="text-align:left; overflow:auto; width:100%;">
                            <span class="pull-left"><a href="{{ route('admin.owners') }}?status=Proffessional">Professionals - <strong>{{ count($data['owners_professional']) }}</strong></a></span>
                        </div>
                        <div style="text-align:left; overflow:auto; width:100%">
                            <span class="pull-left"><a href="{{ route('admin.owners') }}?status=Not Proffessional">Not Professionals - <strong>{{ count($data['owners_not_professional']) }}</strong></a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well" style="height:262px;">
                        <h1 class="color-pink">{{ count($data['reports']) }}</h1>
                        <h2><a href="{{ route('admin.reports') }}">Reports</a></h2>
                        <hr />
                        <div style="text-align:left; overflow:auto; width:100%;">
                            <span class="pull-left"><a href="{{ route('admin.reports') }}?gender=Male">Males - <strong>{{ count($data['reports_males']) }}</strong></a></span>
                        </div>
                        <div style="text-align:left; overflow:auto; width:100%">
                            <span class="pull-left"><a href="{{ route('admin.reports') }}?gender=Female">Females - <strong>{{ count($data['reports_females']) }}</strong></a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well" style="height:262px;">
                        <h1 class="color-pink">{{ count($data['attendances']) }}</h1>
                        <h2><a href="{{ route('admin.attendances') }}">Attendances</a></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well" style="height:262px;">
                        <h1 class="color-pink">{{ count($data['users']) }}</h1>
                        <h2><a href="{{ route('admin.users') }}">Users</a></h2>
                    </div>
                </div>
            </div><!-- close div .row -->
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop