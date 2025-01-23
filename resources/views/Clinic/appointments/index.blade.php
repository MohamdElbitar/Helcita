@extends('Admin.layouts.app')

@section('title', __('Appointments'))

@section('content')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Appointments')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item active">@lang('Appointments')</li>
                        </ol>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <!-- Button to Add New Appointment -->
                            <a href="{{ route('Clinic.appointments.create') }}" class="btn btn-success mb-3">@lang('Add New Appointment')</a>

                            <h4 class="mt-0 header-title">@lang('Appointment List')</h4>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>@lang('Patient')</th>
                                        <th>@lang('Type')</th> <!-- العمود الجديد -->
                                        <th>@lang('Date')</th>
                                        <th>@lang('Time')</th>
                                        <th>@lang('Price')</th>
                                        <th>@lang('Status')</th>
                                        <th>@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->patient->name }}</td>
                                            <td>{{ $appointment->appointment_type == 'checkup' ? __('Checkup') : __('Consultation') }}</td> <!-- عرض نوع الموعد -->
                                            <td>{{ $appointment->appointment_date }}</td>
                                            <td>{{ $appointment->appointment_time }}</td>
                                            <td>{{ $appointment->price }} @lang('EG')</td>
                                            <td>{{ __($appointment->status) }}</td>
                                            <td>
                                                <!-- Add button for changing status to 'Completed' -->
                                                @if($appointment->status !== 'checked')
                                                    <form action="{{ route('Clinic.appointments.complete', $appointment->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">@lang('Mark as Completed')</button>
                                                    </form>
                                                    <a href="{{ route('Clinic.appointments.edit', $appointment->id) }}" class="btn btn-primary btn-sm">@lang('Edit')</a>
                                                    <form action="{{ route('Clinic.appointments.destroy', $appointment->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">@lang('Delete')</button>
                                                    </form>
                                                @else
                                                    <span class="badge badge-success">@lang('checked')</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
