@extends('Admin.layouts.app')

@section('title', __('View Medical Record'))

@section('content')
<style>
    .prescription-container {
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
        background-color: #f9f9f9;
    }

    .prescription-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .prescription-header h5 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    @media print {
        body * {
            visibility: hidden;
        }
        .prescription-container, .prescription-container * {
            visibility: visible;
        }
        .prescription-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
</style>
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

            <div class="card m-b-30">
                <div class="card-body">
                    <!-- Tabs -->
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#patient-info" role="tab">
                                @lang('Patient Information')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#prescription" role="tab">
                                @lang('Prescription')
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Tab 1: Patient Information -->
                        <div class="tab-pane active p-3" id="patient-info" role="tabpanel">
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
                        </div>

                        <!-- Tab 2: Prescription -->
                        <div class="tab-pane p-3" id="prescription" role="tabpanel">
                            <h4>@lang('Medicines')</h4>
                            @if ($medicalRecord->medicines->count() > 0)
                                <div class="prescription-container">
                                    <div class="prescription-header">
                                        <h5>@lang('Helcita Prescription')</h5>
                                        <p><strong>@lang('Patient Name'):</strong> {{ $medicalRecord->patient->name }}</p>
                                        <p><strong>@lang('Date'):</strong> {{ $medicalRecord->created_at->format('Y-m-d') }}</p>
                                    </div>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>@lang('Medicine')</th>
                                                <th>@lang('Dosage (times per day)')</th>
                                                <th>@lang('Duration (days)')</th>
                                                <th>@lang('Time of Intake')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($medicalRecord->medicines as $medicine)
                                                <tr>
                                                    <td>{{ $medicine->name }}</td>
                                                    <td>{{ $medicine->pivot->dosage_times }}</td>
                                                    <td>{{ $medicine->pivot->duration_days }}</td>
                                                    <td>{{ $medicine->pivot->time_of_intake }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <button onclick="printPrescription()" class="btn btn-primary mt-3">@lang('Print Prescription')</button>
                            @else
                                <p>@lang('No medicines prescribed')</p>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="text-right">
                        <a href="{{ route('Clinic.medical_records.index') }}" class="btn btn-secondary">@lang('Back to Medical Records')</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function printPrescription() {
        const printContents = document.querySelector('.prescription-container').innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload(); // إعادة تحميل الصفحة بعد الطباعة
    }
    </script>
@endsection

