        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">@lang('Menu') </li>
                        <li>
                            <a href="{{ route('Admin.home') }}" class="waves-effect">
                                <i class="icon-accelerator"></i><span class="badge badge-success badge-pill float-right"></span> <span> @lang('Dashboard') </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-home"></i><span> @lang('Clinic Management') <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('Admin.Subscribers.index') }}">@lang('Clinics')</a></li>
                                <li><a href="{{ route('Admin.invoices.index') }}">@lang('Invoices')</a></li>
                                <li><a href="{{ route('Admin.subscriptionTypes.index') }}">@lang('Subscription Systems')</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-profile"></i><span> @lang('User Management') <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('Admin.roles.index') }}">@lang('roles')</a></li>
                                <li><a href="{{ route('Admin.permissions.index') }}">@lang('permissions')</a></li>
                                <li><a href="email-compose.html">@lang('users')</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="calendar.html" class="waves-effect"><i class="icon-setting-2"></i><span> @lang('settings') </span></a>
                        </li>

                    </ul>

                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->
