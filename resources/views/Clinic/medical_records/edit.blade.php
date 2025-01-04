@extends('Admin.layouts.app')

@section('title', __('Edit Medical Record'))

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Edit Medical Record')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item active">@lang('Edit Medical Record')</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <form action="{{ route('Clinic.medical_records.update', $medicalRecord->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
    <!-- رسائل النجاح والفشل -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

                                <!-- Patient selection (readonly) -->
                                <div class="form-group">
                                    <label for="patient_id">@lang('Patient')</label>
                                    <select name="patient_id" id="patient_id" class="form-control" required readonly>
                                        <option value="{{ $medicalRecord->patient_id }}">{{ $medicalRecord->patient->name }}</option>
                                    </select>
                                </div>

                                <!-- Diagnosis input -->
                                <div class="form-group">
                                    <label for="diagnosis">@lang('Diagnosis')</label>
                                    <textarea name="diagnosis" id="diagnosis" class="form-control" required>{{ $medicalRecord->diagnosis }}</textarea>
                                </div>

                                <!-- Prescriptions input -->
                                <div class="form-group">
                                    <label for="prescriptions">@lang('Prescriptions')</label>
                                    <textarea name="prescriptions" id="prescriptions" class="form-control">{{ $medicalRecord->prescriptions }}</textarea>
                                </div>

                                <!-- Notes input -->
                                <div class="form-group">
                                    <label for="notes">@lang('Notes')</label>
                                    <textarea name="notes" id="notes" class="form-control">{{ $medicalRecord->notes }}</textarea>
                                </div>

                                <!-- Attachment input -->
                                <div class="form-group">
                                    <label for="attachment">@lang('Attachment')</label>
                                    <input type="file" name="attachment" id="attachment" class="form-control">
                                    @if ($medicalRecord->attachment)
                                        <p><a href="{{ asset('storage/' . $medicalRecord->attachment) }}" target="_blank">@lang('View Current Attachment')</a></p>
                                    @endif
                                </div>

                                <!-- Save and Cancel buttons -->
                                <button type="submit" class="btn btn-success">@lang('Save')</button>
                                <a href="{{ route('Clinic.medical_records.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
