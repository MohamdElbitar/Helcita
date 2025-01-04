@extends('Admin.layouts.app')

@section('title', __('Add Medical Record'))

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Add Medical Record')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item active">@lang('Add Medical Record')</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <form action="{{ route('Clinic.medical_records.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
    <!-- رسالة النجاح أو الفشل -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
                                <!-- حقول إدخال البيانات الأساسية -->
                                <div class="form-group">
                                    <label for="patient_id">@lang('Patient')</label>
                                    <select name="patient_id" id="patient_id" class="form-control" required>
                                        <option value="">@lang('Select Patient')</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="diagnosis">@lang('Diagnosis')</label>
                                    <textarea name="diagnosis" id="diagnosis" class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="prescriptions">@lang('Prescriptions')</label>
                                    <textarea name="prescriptions" id="prescriptions" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="notes">@lang('Notes')</label>
                                    <textarea name="notes" id="notes" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="attachment">@lang('Attachment')</label>
                                    <input type="file" name="attachment" id="attachment" class="form-control">
                                </div>

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
