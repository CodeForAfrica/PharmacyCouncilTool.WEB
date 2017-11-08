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
                    <span class="pull-right"><a href="#">ENG</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">SW</a></span>
                </div><!-- close div .navs -->
            </div><!-- close div .col-md6 -->
        </div><!-- close div .row -->

        <br /><br /><br /><br /><br /><br />
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="motto" id="motto-hakiki">
                    <h1 class="visible-md visible-lg">Hakiki<br/>taarifa za<br />duka la dawa</h1>
                </div>
                <div class="motto" id="motto-ripoti" style="display:none;">
                    <h1 class="visible-md visible-lg">Ripoti<br/>matatizo ya<br />duka la dawa</h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row maduka-tabs">
                    <ul class="nav nav-tabs">
                        <li class="active" id="#hakiki-tab-toggle"><a data-toggle="tab" href="#hakiki-tab">HAKIKI</a></li>
                        <li><a data-toggle="tab" href="#ripoti-tab" id="#ripoti-tab-toggle">RIPOTI</a></li>
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
                                    <input type="text" class="form-control" placeholder="Namba ya Usajili wa Duka la Dawa" id="pharmacy-regno"/>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-lg btn-block btn-pink no-radius" id="hakiki-button" disabled>HAKIKI</button>
                                </div>
                            </div><!-- close div .hakiki-form -->

                            <div class="hakiki-results-found" id="hakiki-results-found" style="display:none;">
                                <div class="alert alert-success" role="alert">
                                    <span class="fa fa-check-circle-o"></span>&nbsp;&nbsp;
                                    <span>Duka la dawa lenye namba <strong class="pharmacy-registration-number">222XX</strong> limesajiliwa.</span>
                                </div><!-- close div .alert-success -->
                                <div class="maelezo">
                                    <br />
                                    <table class="table">
                                        <tr>
                                            <td style="width:30%;"><strong>Jina la Duka</strong></td>
                                            <td><span id="pharmacy-name">Jina Duka</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Muuzaji</strong></td>
                                            <td><span id="pharmacist-name">Jina Muuzaji</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sehemu</strong></td>
                                            <td><span id="pharmacy-location">Jina Sehemu</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tarehe ya Usajili</strong></td>
                                            <td><span id="pharmacy-registration-date">Tarehe</span></td>
                                        </tr>
                                    </table>
                                </div><!-- close div .maelezo -->
                                <button type="button" class="btn btn-pink no-radius btn-block hakiki-duka-jingine-button">HAKIKI DUKA LA DAWA JINGINE</button>
                            </div><!-- close div .hakiki-results-found -->

                            <div class="hakiki-results-not-found" id="hakiki-results-not-found"style="display:none;">
                                <div class="alert alert-danger" role="alert">
                                    <span class="fa fa-ban"></span>&nbsp;&nbsp;
                                    <span>Duka la dawa lenye namba <strong class="pharmacy-registration-number">222XX</strong> halijasajiliwa.</span>
                                </div><!-- close div .alert-success -->
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <br /><br /><br />
                                <button type="button" class="btn btn-pink no-radius btn-block hakiki-duka-jingine-button">HAKIKI DUKA LA DAWA JINGINE</button>
                            </div><!-- closed div .hakiki-results-not-found -->
                        </div><!-- close div #hakiki-tab -->
                        <div id="ripoti-tab" class="tab-pane fade">
                            <div class="hakiki-form no-radius" id="ripoti-form">
                                <div class="form-group">
                                    <select class="form-control" id="gender">
                                        <option value="0" selected="selected">Jinsia yako</option>
                                        <option value="Kiume">Kiume</option>
                                        <option value="Kike">Kike</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="pharmacy_regno" placeholder="Nambari ya usajili wa Duka la Dawa" />
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" id="message" placeholder="Tatizo"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-lg btn-block btn-pink no-radius" id="ripoti-button" disabled>RIPOTI</button>
                                </div>
                            </div><!-- close div .hakiki-form -->

                            <div id="ripoti-results" style="display:none;">
                                 <div class="alert alert-success" role="alert">
                                    <span class="fa fa-check-circle-o"></span>&nbsp;&nbsp;
                                    <span>Asante kwa kuripoti tatizo kwenye duka la dawa.</span>
                                </div><!-- close div .alert-success -->
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <br /><br /><br />
                                <button type="button" class="btn btn-pink no-radius btn-block ripoti-tatizo-jingine-button">RIPOTI TATIZO JINGINE</button>
                            </div><!-- close div #ripoti-results -->
                        </div><!-- close div #ripoti-tab -->
                    </div>
                </div>
            </div><!-- close div .col-md-6 -->
        </div><!-- close div .row -->
    </div><!-- close div .container -->
</div><!-- close div .container-fluid -->