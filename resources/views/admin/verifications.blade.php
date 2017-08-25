@extends('layouts.master')

@section('title')
    Administrator - Verifications | Maduka ya Madawa - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid">
        @include('admin.includes.navigations')

        <div class="row admin-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1>Verifications</h1>
                </div>
            </div>
        </div><!-- close div .admin-bottom -->

        <div class="row admin-contents">
            @if ($data['verifications'])
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gender</th>
                        <th>Location</th>
                        <th>Message</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody style="text-align:left;">
                        <?php $n=1; ?>
                        @foreach($data['reports'] as $report)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $report->gender }}</td>
                            <td>{{ $report->location }}</td>
                            <td>{{ $report->message }}</td>
                            <td>
                                <button type="button" class="btn btn-xs btn-danger" disabled style="margin-right:10px;">Delete</button>
                                <button type="button" class="btn btn-xs btn-warning" disabled style="margin-right:10px;">Edit</button>
                                <button type="button" class="btn btn-xs btn-success" disabled>View</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h2>There is no any Verification.</h2>
            @endif
        </div><!-- close div .admin-contents -->
    </div><!-- close div .container-fluid -->
@stop