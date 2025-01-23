<!DOCTYPE html>
    <html lang="{{ LaravelLocalization::getCurrentLocale() }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
    dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" data-theme="theme-default"
    data-assets-path="{{ url('assets') }}/" data-template="vertical-menu-template-starter">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>@lang('Helcita')</title>
        <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
        <meta content="Themesdesign" name="author" />
        <link rel="shortcut icon" href="{{ url("assets/images/favicon.ico") }}">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{ url("assets/plugins/morris/morris.css") }}">

        <link href="{{ url("assets/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css">
        <link href="{{ url("assets/css/metismenu.min.css") }}" rel="stylesheet" type="text/css">
        <link href="{{ url("assets/css/icons.css") }}" rel="stylesheet" type="text/css">
        <link href="{{ url("assets/css/style.css") }}" rel="stylesheet" type="text/css">
        <!-- DataTables -->
        <link href="{{ url("assets/plugins/datatables/dataTables.bootstrap4.min.css") }}" rel="stylesheet" type="text/css" />
        <link href="{{ url("assets/plugins/datatables/buttons.bootstrap4.min.css") }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ url("assets/plugins/datatables/responsive.bootstrap4.min.css") }}" rel="stylesheet" type="text/css" />

            <!--calendar css-->
            <link href="{{ url("assets/plugins/fullcalendar/css/fullcalendar.min.css") }}" rel="stylesheet" />

            <link href="{{ url("assets/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css">
            <link href="{{ url("assets/css/metismenu.min.css") }}" rel="stylesheet" type="text/css">
            <link href="{{ url("assets/css/icons.css") }}" rel="stylesheet" type="text/css">
            <link href="{{ url("assets/css/style.css") }}" rel="stylesheet" type="text/css">
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

    </head>

    <body>

    <!-- Begin page -->
    <div id="wrapper">
        @include('Admin.layouts.navbar')

    @if(Auth::check() && auth()->user()->is_admin)
        @include('Admin.layouts.inc.Admin')
        @else
        @include('Admin.layouts.Inc.Clinic')
        @endif
        @yield('content')
        @include('Admin.layouts.footer')
    </div>


</body>

</html>
