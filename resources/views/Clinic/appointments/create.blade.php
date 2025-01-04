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
                                
                                <div class="form-group">
                                    <label for="patient_id">@lang('Patient')</label>
                                    <select name="patient_id" class="form-control" required>
                                        <option value="">@lang('Select Patient')</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}">{{ $patient->name }} - {{ $patient->phone }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="appointment_date">@lang('Appointment Date')</label>
                                    <input type="date" name="appointment_date" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="appointment_time">@lang('Appointment Time')</label>
                                    <input type="time" name="appointment_time" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="price">@lang('Price')</label>
                                    <input type="number" name="price" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-success">@lang('Save Appointment')</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
