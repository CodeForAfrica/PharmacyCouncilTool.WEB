<div class="container-fluid container-fluid-purple">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <br /><br />
                <img class="visible-md visible-lg" src="images/pharmacy.png" />
                <img class="visible-xs visible-sm" src="images/pharmacy.png" style="width:48px;" />
            </div><!-- close div .col-md6 -->
            <div class="col-sx-6 col-sm-6 col-md-6" style="padding-left:0px;padding-right:0px;">
                <br /><br />
                <div class="navs">
                    <!--
                    <ul>
                        <li><a href="#simu-ya-mkononi">Simu ya Mkononi</a></li>
                    </ul>
                    -->
                    <span class="pull-right">
                        <a href="{{ route('switchlanguage') }}?lang=en">ENG</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="{{ route('switchlanguage') }}?lang=sw">SW</a>
                    </span>
                </div><!-- close div .navs -->
            </div><!-- close div .col-md6 -->
        </div><!-- close div .row -->

        <br /><br /><br /><br /><br /><br />
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="motto" id="motto-hakiki">
                    <h1 class="visible-md visible-lg">{{ trans('app.Verify') }}<?php if(session('locale') == "sw") echo '<br/>taarifa za'; ?><br />{{ trans('app.A_Pharmacy') }}</h1>
                </div>
                <div class="motto" id="motto-ripoti" style="display:none;">
                    <h1 class="visible-md visible-lg">{{ trans('app.Report') }}<?php if(session('locale') == "sw") echo '<br/>matatizo ya'; ?><br />{{ trans('app.A_Pharmacy') }}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row maduka-tabs">
                    <ul class="nav nav-tabs">
                        <li class="active" id="#hakiki-tab-toggle"><a data-toggle="tab" href="#hakiki-tab">{{ strtoupper(trans('app.Verify')) }}</a></li>
                        <li><a data-toggle="tab" href="#ripoti-tab" id="#ripoti-tab-toggle">{{ strtoupper(trans('app.Report')) }}</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="hakiki-tab" class="tab-pane fade in active">
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
                                    <br />
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
            </div><!-- close div .col-md-6 -->
        </div><!-- close div .row -->
    </div><!-- close div .container -->
</div><!-- close div .container-fluid -->