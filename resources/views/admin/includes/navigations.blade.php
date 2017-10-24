<div class="row admin-top">
    <div class="col-md-10">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('images/pharmacy.png') }}" /></a>
        </div>
        <div class="navs">
            <ul>
                <li class="{{ $data['page'] == 'Dashboard' ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="{{ $data['page'] == 'Dispensers' ? 'active' : '' }}"><a href="{{ route('admin.dispensers') }}">Dispensers</a></li>
                <li class="{{ $data['page'] == 'Addos' ? 'active' : '' }}"><a href="{{ route('admin.addos') }}">Addos</a></li>
                <li class="{{ $data['page'] == 'Pharmacists' ? 'active' : '' }}"><a href="{{ route('admin.pharmacists') }}">Pharmacists</a></li>
                <li class="{{ $data['page'] == 'Pharmacies' ? 'active' : '' }}"><a href="{{ route('admin.pharmacies') }}">Pharmacies</a></li>
                <li class="{{ $data['page'] == 'Owners' ? 'active' : '' }}"><a href="{{ route('admin.owners') }}">Owners</a></li>
                <li class="{{ $data['page'] == 'Reports' ? 'active' : '' }}"><a href="{{ route('admin.reports') }}">Reports</a></li>
                <li class="{{ $data['page'] == 'Users' ? 'active' : '' }}"><a href="{{ route('admin.users') }}">Users</a></li>
            </ul>
        </div><!-- close div .navs -->
    </div><!-- close div .col-md9 -->
    <div class="col-md-2 user-menu">
        <div class="dropdown">
            <div class="dropdown-toggle" data-toggle="dropdown">
                <span class="fa fa-angle-down arrow-down pull-right"></span>
                <div class="image pull-right">
                    <span class="fa fa-user"></span>
                </div><!-- close div .image -->
                <span class="admin-name pull-right">Hi, {{ $user->name }}!</span>
            </div><!-- close div .dropdown-toggle -->
            <ul class="dropdown-menu pull-right" style="top:60px;">
                <li><a href="#" data-toggle="modal" data-target="#apiTokenModal">API Token</a></li>
                <li><a href="#">My Account</a></li>
                <li><a href="{{ route('admin.logout') }}">Logout</a></li>
            </ul>
        </div><!-- close div .dropdown -->
    </div><!-- close div .user-menu -->

    <!-- Modal -->
    <div id="apiTokenModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Your API Token</h4>
                </div>
                <div class="modal-body">
                    <p>{{ $user->api_token }}</p>
                </div>
            </div><!-- close div .modal-content -->
        </div>
    </div><!-- close div .modal -->
</div><!-- close div .admin-top -->