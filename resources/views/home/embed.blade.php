@extends('layouts.master')

@section('title')
    Maduka ya Madawa - Embed | Code for Tanzania
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row maduka-tabs">
                    <ul class="nav nav-tabs">
                        <li class="active"  id="#tafuta-tab-toggle"><a data-toggle="tab" href="#tafuta-tab">{{ strtoupper(trans('app.LookUp')) }}</a></li>
                        <li id="#hakiki-tab-toggle"><a data-toggle="tab" href="#hakiki-tab">{{ strtoupper(trans('app.Verify')) }}</a></li>
                        <li><a data-toggle="tab" href="#ripoti-tab" id="#ripoti-tab-toggle">{{ strtoupper(trans('app.Report')) }}</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="tafuta-tab" class="tab-pane fade in active">
                            <div class="hakiki-form no-radius" id="tafuta-form" style="display: ;">
                                <span>{{ trans('app.Choose_A_Place') }}</span>

                                <div class="row">
                                    <div class="col-xs-4">
                                        <select class="form-control" id="region">
                                            <option value="0" selected="selected">{{ trans('app.Region') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <select class="form-control" id="district" disabled>
                                            <option value="0" selected="selected">{{ trans('app.District') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <select class="form-control" id="ward" disabled>
                                            <option value="0" selected="selected">{{ trans('app.Ward') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <hr />

                                <span>{{ trans('app.OR') }} {{ trans('app.Enter_Pharmacy_Name') }}</span>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="{{ trans('app.Pharmacy_Name') }}" id="tafuta-pharmacy-name"/>
                                </div>
                                <br />
                                <div class="form-group">
                                    <button type="button" class="btn btn-lg btn-block btn-pink no-radius" id="tafuta-button" disabled>{{ strtoupper(trans('app.LookUp')) }}</button>
                                </div>
                            </div><!-- close div #tafuta-form -->

                            <div class="tafuta-results-found" id="tafuta-results-found" style="display: none;">
                                <div class="alert alert-success" role="alert">
                                    <span class="fa fa-check-circle-o"></span>&nbsp;&nbsp;
                                    <span class="tafuta-query"></span>
                                </div><!-- close div .alert-success -->
                                <div class="maelezo" style="height: 160px; overflow: scroll; overflow-x: hidden;">
                                    <table id="tafuta-results-data" class="table table-results">
                                        
                                    </table>
                                </div><!-- close div .maelezo -->
                                <br />
                                <br />
                                <button type="button" class="btn btn-pink no-radius btn-block tafuta-duka-jingine-button">{{ strtoupper(trans('app.Find_Another_Pharmacies')) }}</button>
                            </div><!-- close div .tafuta-results-found -->

                            <div class="tafuta-results-not-found" id="tafuta-results-not-found"style="display:none;">
                                <div class="alert alert-danger" role="alert">
                                    <span class="fa fa-ban"></span>&nbsp;&nbsp;
                                    <span>{{ trans('app.No_Pharmacy_Found') }}</span>
                                </div><!-- close div .alert-success -->
                                <p>{{ trans('app.Pharmacy_Not_Found_Based_On_That_Location_Message') }}</p>
                                <p>{{ trans('app.Pharmacy_Not_Found_Message_Two') }}</p>
                                <br /><br /><br />
                                <button type="button" class="btn btn-pink no-radius btn-block tafuta-duka-jingine-button">{{ trans('app.Find_Another_Pharmacies') }}</button>
                            </div><!-- closed div .tafuta-results-not-found -->

                        </div><!-- close div #tafuta-form -->
                        <div id="hakiki-tab" class="tab-pane fade">
                            <div class="hakiki-form no-radius" id="hakiki-form" style="display:;">
                                <div class="arrow_box">
                                    <img src="images/sticker_blured.jpg" class="img-responsive"/>
                                </div>
                                <br />
                                <br />
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="{{ trans('app.Pharmacy_Registration_Number') }}" id="pharmacy-regno"/>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-lg btn-block btn-pink no-radius" id="hakiki-button" disabled>{{ strtoupper(trans('app.Verify')) }}</button>
                                </div>
                            </div><!-- close div .hakiki-form -->

                            <div class="hakiki-results-found" id="hakiki-results-found" style="display:none;">
                                <div class="alert alert-success" role="alert">
                                    <span class="fa fa-check-circle-o"></span>&nbsp;&nbsp;
                                    <span>{{ trans('app.Pharmacy_With_Registration_Number') }}<strong class="pharmacy-registration-number">222XX</strong> {{ trans('app.Is_Registered') }}</span>
                                </div><!-- close div .alert-success -->
                                <div class="maelezo">
                                    <table class="table">
                                        <tr>
                                            <td style="width:30%;"><strong>{{ trans('app.Pharmacy_Name') }}</strong></td>
                                            <td><span id="pharmacy-name">Jina Duka</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ trans('app.Pharmacist') }}</strong></td>
                                            <td><span id="pharmacist-name">Jina Muuzaji</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ trans('app.Location') }}</strong></td>
                                            <td><span id="pharmacy-location">Jina Sehemu</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ trans('app.Registration_Date') }}</strong></td>
                                            <td><span id="pharmacy-registration-date">Tarehe</span></td>
                                        </tr>
                                    </table>
                                </div><!-- close div .maelezo -->
                                <button type="button" class="btn btn-pink no-radius btn-block hakiki-duka-jingine-button">{{ trans('app.Verify_Another_Pharmacy') }}</button>
                            </div><!-- close div .hakiki-results-found -->

                            <div class="hakiki-results-not-found" id="hakiki-results-not-found"style="display:none;">
                                <div class="alert alert-danger" role="alert">
                                    <span class="fa fa-ban"></span>&nbsp;&nbsp;
                                    <span>{{ trans('app.Pharmacy_With_Registration_Number') }} <strong class="pharmacy-registration-number">222XX</strong> {{ trans('app.Is_Not_Registered') }}</span>
                                </div><!-- close div .alert-success -->
                                <p>{{ trans('app.Pharmacy_Not_Found_Message') }}</p>
                                <p>{{ trans('app.Pharmacy_Not_Found_Message_Two') }}</p>
                                <br /><br /><br />
                                <button type="button" class="btn btn-pink no-radius btn-block hakiki-duka-jingine-button">{{ trans('app.Verify_Another_Pharmacy') }}</button>
                            </div><!-- closed div .hakiki-results-not-found -->
                        </div><!-- close div #hakiki-tab -->
                        <div id="ripoti-tab" class="tab-pane fade">
                            <div class="hakiki-form no-radius" id="ripoti-form">
                                <div class="form-group">
                                    <select class="form-control" id="gender">
                                        <option value="0" selected="selected">{{ trans('app.Your_Gender') }}</option>
                                        <option value="Male">{{ trans('app.Male') }}</option>
                                        <option value="Female">{{ trans('app.Female') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="pharmacy_regno" placeholder="{{ trans('app.Pharmacy_Registration_Number') }}" />
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" id="message" placeholder="{{ trans('app.Problem') }}"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-lg btn-block btn-pink no-radius" id="ripoti-button" disabled>{{ strtoupper(trans('app.Report')) }}</button>
                                </div>
                            </div><!-- close div .hakiki-form -->

                            <div id="ripoti-results" style="display:none;">
                                 <div class="alert alert-success" role="alert">
                                    <span class="fa fa-check-circle-o"></span>&nbsp;&nbsp;
                                    <span>{{ trans('app.Thank_You_For_Reporting_A_Pharmacy') }}</span>
                                </div><!-- close div .alert-success -->
                                <p>{{ trans('app.Thank_You_For_Reporting_A_Pharmacy_Message') }}</p>
                                <p>{{ trans('app.Thank_You_For_Reporting_A_Pharmacy_Message_Two') }}</p>
                                <br /><br /><br />
                                <button type="button" class="btn btn-pink no-radius btn-block ripoti-tatizo-jingine-button">{{ trans('app.Report_Another_Problem') }}</button>
                            </div><!-- close div #ripoti-results -->
                        </div><!-- close div #ripoti-tab -->
                    </div>
                </div>
            </div><!-- close div .col-md-12 -->
        </div>
    </div>
@stop