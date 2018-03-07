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
                        <h1 class="color-pink" id="total_dispensers">0</h1>
                        <h2><a href="{{ route('admin.dispensers') }}">Dispensers</a></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well" style="height:262px;">
                        <h1 class="color-pink" id="total_addos">0</h1>
                        <h2><a href="{{ route('admin.addos') }}">Addos</a></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well">
                        <h1 class="color-pink" id="total_personnels">0</h1>
                        <h3><a href="{{ route('admin.personnel') }}">Personnels</a></h3>
                        <hr />
                        <div style="text-align:left; overflow:auto; width:100%;">
                            <span class="pull-left"><a href="{{ route('admin.personnel') }}?type=Pharmacist">Pharmacists - <strong id="total_personnels_pharmacists">0</strong></a></span>
                        </div>
                        <div style="text-align:left; overflow:auto; width:100%">
                            <span class="pull-left"><a href="{{ route('admin.personnel') }}?type=Pharmaceutical Technician">Pharmaceutical Technicians - <strong id="total_personnels_pharmaceutical_technicians">0</strong></a></span>
                        </div>
                        <div style="text-align:left; overflow:auto; width:100%">
                            <span class="pull-left"><a href="{{ route('admin.personnel') }}?type=Medical Representative">Medical Representatives - <strong id="total_personnels_medical_representatives">0</strong></a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well">
                        <h1 class="color-pink" id="total_pharmacies">0</h1>
                        <h3><a href="{{ route('admin.pharmacies') }}">Pharmacies</a></h3>
                        <hr />
                        <div style="text-align:left; overflow:auto; width:100%;">
                            <span class="pull-left"><a href="{{ route('admin.pharmacies') }}?status=Renewed">Renewed - <strong id="total_pharmacies_renewed">0</strong></a></span>
                            <span class="pull-right"><a href="{{ route('admin.pharmacies') }}?status=Not Renewed">Not Renewed - <strong id="total_pharmacies_not_renewed">0</strong></a></span>
                        </div>
                        <div style="text-align:left; overflow:auto; width:100%">
                            <span class="pull-left"><a href="{{ route('admin.pharmacies') }}?status=Pending">Pending - <strong id="total_pharmacies_pending">0</strong></a></span>
                            <span class="pull-right"><a href="{{ route('admin.pharmacies') }}?status=Waiting Permit">Waiting Permit - <strong id="total_pharmacies_waiting_permit">0</strong></a></span>
                        </div>
                        <div style="text-align:left; overflow:auto; width:100%">
                            <span class="pull-left"><a href="{{ route('admin.pharmacies') }}?status=Closed">Closed - <strong id="total_pharmacies_closed">0</strong></a></span>
                            <span class="pull-right"><a href="{{ route('admin.pharmacies') }}?status=Temporary Closed">Temporary Closed - <strong id="total_pharmacies_temporary_closed">0</strong></a></span>
                        </div>
                    </div>
                </div>
            </div><!-- close div .row -->
            <hr />
            <br />
            <div class="row">
                <div class="col-md-3">
                    <div class="well" style="height:262px;">
                        <h1 class="color-pink" id="total_owners">0</h1>
                        <h3><a href="{{ route('admin.owners') }}">Owners</a></h3>
                        <hr />
                        <div style="text-align:left; overflow:auto; width:100%;">
                            <span class="pull-left"><a href="{{ route('admin.owners') }}?status=Proffessional">Professionals - <strong id="total_owners_professional">0</strong></a></span>
                        </div>
                        <div style="text-align:left; overflow:auto; width:100%">
                            <span class="pull-left"><a href="{{ route('admin.owners') }}?status=Not Proffessional">Not Professionals - <strong id="total_owners_not_professional">0</strong></a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well" style="height:262px;">
                        <h1 class="color-pink" id="total_reports">0</h1>
                        <h2><a href="{{ route('admin.reports') }}">Reports</a></h2>
                        <hr />
                        <div style="text-align:left; overflow:auto; width:100%;">
                            <span class="pull-left"><a href="{{ route('admin.reports') }}?gender=Male">Males - <strong id="total_reports_males">0</strong></a></span>
                        </div>
                        <div style="text-align:left; overflow:auto; width:100%">
                            <span class="pull-left"><a href="{{ route('admin.reports') }}?gender=Female">Females - <strong id="total_reports_females">0</strong></a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well" style="height:262px;">
                        <h1 class="color-pink" id="total_attendances">0</h1>
                        <h2><a href="{{ route('admin.attendances') }}">Attendances</a></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well" style="height:262px;">
                        <h1 class="color-pink" id="total_users">0</h1>
                        <h2><a href="{{ route('admin.users') }}">Users</a></h2>
                    </div>
                </div>
            </div><!-- close div .row -->
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop

@section('scripts')
    <script>
        getDispensersData();
        getAddosData();
        getPersonnelsData();
        getPharmaciesData();
        getOwnersData();
        getReportsData();
        getAttendancesData();
        getUsersData();

        function getDispensersData(){
            // Fetching data
            let type = "GET";
            let url =  "/admin/dashboard/getdispensersdata";

            $.ajax({
                type: type,
                url: url,
                success: function (data) {
                    // Updating
                    $('#total_dispensers').html(data.total_dispensers);
                },
                error: function (data) {
                    // Error: Message
                }
            });
        }

        function getAddosData(){
            // Fetching data
            let type = "GET";
            let url =  "/admin/dashboard/getaddosdata";

            $.ajax({
                type: type,
                url: url,
                success: function (data) {
                    // Updating
                    $('#total_addos').html(data.total_addos);
                },
                error: function (data) {
                    // Error: Message
                }
            });
        }

        function getPersonnelsData(){
            // Fetching data
            let type = "GET";
            let url =  "/admin/dashboard/getpersonnelsdata";

            $.ajax({
                type: type,
                url: url,
                success: function (data) {
                    // Updating
                    $('#total_personnels').html(data.total_personnels);
                    $('#total_personnels_pharmacists').html(data.total_personnels_pharmacists);
                    $('#total_personnels_pharmaceutical_technicians').html(data.total_personnels_pharmaceutical_technicians);
                    $('#total_personnels_medical_representatives').html(data.total_personnels_medical_representatives);
                },
                error: function (data) {
                    // Error: Message
                    console.log(data);
                }
            });
        }

        function getPharmaciesData(){
            // Fetching data
            let type = "GET";
            let url =  "/admin/dashboard/getpharmaciesdata";

            $.ajax({
                type: type,
                url: url,
                success: function (data) {
                    // Updating
                    $('#total_pharmacies').html(data.total_pharmacies);
                    $('#total_pharmacies_renewed').html(data.total_pharmacies_renewed);
                    $('#total_pharmacies_not_renewed').html(data.total_pharmacies_not_renewed);
                    $('#total_pharmacies_pending').html(data.total_pharmacies_pending);
                    $('#total_pharmacies_waiting_permit').html(data.total_pharmacies_waiting_permit);
                    $('#total_pharmacies_closed').html(data.total_pharmacies_closed);
                    $('#total_pharmacies_temporary_closed').html(data.total_pharmacies_temporary_closed);
                },
                error: function (data) {
                    // Error: Message
                }
            });
        }

        function getOwnersData(){
            // Fetching data
            let type = "GET";
            let url =  "/admin/dashboard/getownersdata";

            $.ajax({
                type: type,
                url: url,
                success: function (data) {
                    // Updating
                    $('#total_owners').html(data.total_owners);
                    $('#total_owners_professional').html(data.total_owners_professionals);
                    $('#total_owners_not_professional').html(data.total_owners_not_professionals);
                },
                error: function (data) {
                    // Error: Message
                }
            });
        }

        function getReportsData(){
            // Fetching data
            let type = "GET";
            let url =  "/admin/dashboard/getreportsdata";

            $.ajax({
                type: type,
                url: url,
                success: function (data) {
                    // Updating
                    console.log(data);
                    $('#total_reports').html(data.total_reports);
                    $('#total_reports_males').html(data.total_reports_males);
                    $('#total_reports_females').html(data.total_reports_females);
                },
                error: function (data) {
                    // Error: Message
                }
            });
        }

        function getAttendancesData(){
            // Fetching data
            let type = "GET";
            let url =  "/admin/dashboard/getattendancesdata";

            $.ajax({
                type: type,
                url: url,
                success: function (data) {
                    // Updating
                    $('#total_attendances').html(data.total_attendances);
                },
                error: function (data) {
                    // Error: Message
                }
            });
        }

        function getUsersData(){
            // Fetching data
            let type = "GET";
            let url =  "/admin/dashboard/getusersdata";

            $.ajax({
                type: type,
                url: url,
                success: function (data) {
                    // Updating
                    $('#total_users').html(data.total_users);
                },
                error: function (data) {
                    // Error: Message
                }
            });
        }
    </script>
@stop