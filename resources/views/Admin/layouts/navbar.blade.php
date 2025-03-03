
        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            {{-- <div class="topbar-left">
                <a href="index.html" class="logo">
                    <span class="logo-light">
                            <i class="mdi mdi-camera-control"></i> @lang('Helcita')
                        </span>
                    <span class="logo-sm">
                            <i class="mdi mdi-camera-control"></i>
                        </span>
                </a>
            </div> --}}

            <div class="topbar-left">
                <a href="{{ url('/') }}" class="logo">
                    <span class="logo-light">
                        <img src="{{ asset('assets/images/Helcita_LOGO.png') }}" alt="Helcita Logo" style="width: 80px; height: auto;">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/Helcita_LOGO.png') }}" alt="Helcita Logo" style="width: 20px; height: auto;">
                    </span>
                </a>
            </div>

            <nav class="navbar-custom">
                <ul class="navbar-right list-inline float-right mb-0">

                    <!-- language-->
                <!-- language -->
                <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('assets/images/flags/us_flag.jpg') }}" class="mr-2" height="12" alt="" />
                        {{ LaravelLocalization::getCurrentLocale() == 'en' ? 'English' : 'العربية' }}
                        <span class="mdi mdi-chevron-down"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                        <!-- الإنجليزية -->
                        <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                            <img src="{{ asset('assets/images/flags/us_flag.jpg') }}" alt="" height="16" />
                            <span>English</span>
                        </a>

                        <!-- العربية -->
                        <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('ar') }}">
                            <img src="{{ asset('assets/images/flags/saudi_arabia_flag.jpg') }}" alt="" height="16" />
                            <span>العربية</span>
                        </a>
                    </div>
                </li>
                    <!-- full screen -->
                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                            <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                        </a>
                    </li>

                  <!-- notification -->
                    <!-- notification -->
                    @if(auth()->user()->hasRole('admin'))
                    <li class="dropdown notification-list list-inline-item">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell-outline noti-icon"></i>
                            <span class="badge badge-pill badge-danger noti-icon-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                            <!-- item-->
                            <h6 class="dropdown-item-text">
                                Notifications
                            </h6>
                            <div class="slimscroll notification-item-list">
                                @foreach(auth()->user()->notifications as $notification)
                                <a href="{{ route('notifications.read', $notification->id) }}" class="dropdown-item notify-item {{ $notification->read_at ? '' : 'active' }}">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details">
                                        <b>{{ $notification->data['message'] }}</b>
                                        <span class="text-muted">{{ $notification->data['appointment_time'] }}</span>
                                    </p>
                                </a>
                            @endforeach

                            </div>
                            <!-- All-->
                            <a href="{{ route('notifications.index') }}" class="dropdown-item text-center notify-all text-primary">
                                View all <i class="fi-arrow-right"></i>
                            </a>
                        </div>
                    </li>


                    @elseif (auth()->user()->hasRole('clinic'))

                    <li class="dropdown notification-list list-inline-item">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell-outline noti-icon"></i>
                            <span class="badge badge-pill badge-danger noti-icon-badge">{{ auth()->user()->ClinicData->unreadNotifications->count() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                            <!-- item-->
                            <h6 class="dropdown-item-text">
                                Notifications
                            </h6>
                            <div class="slimscroll notification-item-list">
                                @foreach(auth()->user()->ClinicData->notifications as $notification)
                                <a href="{{ route('notifications.read', $notification->id) }}" class="dropdown-item notify-item {{ $notification->read_at ? '' : 'active' }}">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details">
                                        <b>{{ $notification->data['message'] }}</b>
                                        <span class="text-muted">{{ $notification->data['appointment_time'] }}</span>
                                    </p>
                                </a>
                            @endforeach

                            </div>
                            <!-- All-->
                            <a href="{{ route('notifications.index') }}" class="dropdown-item text-center notify-all text-primary">
                                View all <i class="fi-arrow-right"></i>
                            </a>
                        </div>
                    </li>


                    @endif


                    <li class="dropdown notification-list list-inline-item">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('assets/images/users/avatar-icon-images-4.jpg')}}" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ route('Clinic.financial.index') }}"><i class="mdi mdi-wallet"></i> @lang('Financial')</a>
                                <a class="dropdown-item d-block" href="{{ route('Clinic.settings.index') }}"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings"></i>@lang('settings')</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                                    @csrf
                                </form>

                                <a href="javascript:void(0);" class="dropdown-item text-danger" onclick="document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-power text-danger"></i> Logout
                                </a>
                            </div>
                        </div>
                    </li>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                    <li class="d-none d-md-inline-block">
                        <form role="search" class="app-search">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" placeholder="Search..">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </li>
                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->
