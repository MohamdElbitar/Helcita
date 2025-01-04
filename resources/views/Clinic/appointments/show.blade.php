@extends('Admin.layouts.app')

@section('title', __('View Appointment'))

@section('content')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Appointment Details')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('Clinic.appointments.index') }}">@lang('Appointments')</a></li>
                            <li class="breadcrumb-item active">@lang('View Appointment')</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h5>@lang('Appointment Information')</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>@lang('Patient')</th>
                                    <td>{{ $appointment->patient->name }} - {{ $appointment->patient->phone }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Appointment Date')</th>
                                    <td>{{ $appointment->appointment_date }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Appointment Time')</th>
                                    <td>{{ $appointment->appointment_time }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Price')</th>
                                    <td>{{ $appointment->price }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Status')</th>
                                    <td>{{ $appointment->status ?? __('Pending') }}</td>
                                </tr>
                            </table>

                            <a href="{{ route('Clinic.appointments.index') }}" class="btn btn-primary">@lang('Back to Appointments')</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
