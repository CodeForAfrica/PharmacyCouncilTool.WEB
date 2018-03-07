@extends('layouts.master')

@section('title')
    Administrator - Reports | Maduka ya Madawa - Code for Tanzania
@stop

@section('styles')
<link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
    <div class="container-fluid margin-bottom-100px">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Reports</h1>
                    <?php
                        if($data['gender'] != ""){?>
                            <h5 class="color-pink">{{$data['gender']}}s</h5>
                        <?php }
                    ?>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            @if(Session::has('message'))
                <div class="alert alert-{{Session::get('class')}}" role="alert" style="text-align:left;">
                    {{Session::get('message')}}
                </div>
            @endif

            <table id="myTable" class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Gender</th>
                    <th>Pharmacy Registration Number</th>
                    <th>Message</th>
                    <th style="width:130px;">Options</th>
                </tr>
                </thead>
            </table>
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop

@section('scripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('admin.reports.datatable') !!}',
                    "dataType": "json",
                    "type": "POST",
                    "data": { _token: "{{csrf_token()}}", gender: "{{$data['gender']}}"}
                },
                columns: [
                    { "data": "id" },
                    { "data": "gender" },
                    { "data": "pharmacy_registration_no" },
                    { "data": "message" },
                    { "data": "options", "orderable": false }
                ]
            });
        });
    </script>
@stop