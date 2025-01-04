<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">@lang('Menu')</li>

                <!-- Dashboard Section -->
                <li>
                    <a href="{{ route('Clinic.home') }}" class="waves-effect">
                        <i class="icon-accelerator"></i><span class="badge badge-success badge-pill float-right"></span> <span> @lang('Dashboard') </span>
                    </a>
                </li>

                <!-- New Sections: Management -->
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-calendar"></i><span> @lang('Appointment Management') <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{ route('Clinic.appointments.index') }}">@lang('Appointments')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-profile"></i><span> @lang('Employee Management') <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{ route('Clinic.employees.index') }}">@lang('Employees')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-profile"></i><span> @lang('Patient Management') <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{ route('Clinic.patients.index') }}">@lang('Patients')</a></li>
                        <li><a href="{{ route('Clinic.medical_records.index') }}">@lang('Medical Records')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-profile"></i><span> @lang('Financial Management') <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{ route('Clinic.financial.index') }}">@lang('Financial')</a></li>
                    </ul>
                </li>


                <!-- Settings Section -->
                <li>
                    <a href="{{ route('Clinic.settings.index') }}" class="waves-effect"><i class="icon-setting-2"></i><span> @lang('Settings') </span></a>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
