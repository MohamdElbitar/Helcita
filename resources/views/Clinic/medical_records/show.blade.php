@extends('Admin.layouts.app')

@section('title', __('View Medical Record'))

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('View Medical Record')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item active">@lang('View Medical Record')</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4>@lang('Patient Information')</h4>
                            <p><strong>@lang('Patient Name'):</strong> {{ $medicalRecord->patient->name }}</p>
                            <p><strong>@lang('Patient Phone'):</strong> {{ $medicalRecord->patient->phone }}</p>

                            <hr>

                            <h4>@lang('Diagnosis')</h4>
                            <p>{{ $medicalRecord->diagnosis }}</p>

                            <hr>

                            <h4>@lang('Prescriptions')</h4>
                            <p>{{ $medicalRecord->prescriptions ?? __('No prescriptions available') }}</p>

                            <hr>

                            <h4>@lang('Notes')</h4>
                            <p>{{ $medicalRecord->notes ?? __('No additional notes available') }}</p>

                            <hr>

                            <h4>@lang('Attachment')</h4>
                            @if ($medicalRecord->attachment)
                                <p><a href="{{ asset('storage/' . $medicalRecord->attachment) }}" target="_blank">@lang('View Attachment')</a></p>
                            @else
                                <p>@lang('No attachment available')</p>
                            @endif

                            <hr>

                            <div class="text-right">
                                <a href="{{ route('Clinic.medical_records.index') }}" class="btn btn-secondary">@lang('Back to Medical Records')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
