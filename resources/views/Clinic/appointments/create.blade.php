@extends('Admin.layouts.app')

@section('title', __('Add Appointment'))

@section('content')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Add New Appointment')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('Clinic.appointments.index') }}">@lang('Appointments')</a></li>
                            <li class="breadcrumb-item active">@lang('Add New Appointment')</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">

                            <form action="{{ route('Clinic.appointments.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_id">@lang('Patient')</label>
                                            <select name="patient_id" class="form-control" required>
                                                <option value="">@lang('Select Patient')</option>
                                                @foreach($patients as $patient)
                                                    <option value="{{ $patient->id }}">{{ $patient->name }} - {{ $patient->phone }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointment_date">@lang('Appointment Date')</label>
                                            <input type="date" name="appointment_date" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointment_time">@lang('Appointment Time')</label>
                                            <input type="time" name="appointment_time" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">@lang('Price')</label>
                                            <input type="number" name="price" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>@lang('Appointment Type')</label><br>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="type_checkup" name="appointment_type" value="checkup" class="form-check-input" required>
                                                <label class="form-check-label" for="type_checkup">@lang('Checkup')</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="type_consultation" name="appointment_type" value="consultation" class="form-check-input" required>
                                                <label class="form-check-label" for="type_consultation">@lang('Consultation')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">@lang('Save Appointment')</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
