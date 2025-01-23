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
                            <li class="breadcrumb-item"><a href="{{ route('Clinic.medical_records.index') }}">@lang('Medical Records')</a></li>
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

                                <!-- Tabs -->
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">
                                            <span class="d-none d-md-block">@lang('Basic Details')</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab">
                                            <span class="d-none d-md-block">@lang('Prescription Details')</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                                        <div class="form-group">
                                            <label for="patient_id">@lang('Patient')</label>
                                            <select name="patient_id" id="patient_id" class="form-control" required>
                                                <option value="">@lang('Select Patient')</option>
                                                @foreach($patients as $patient)
                                                    <option value="{{ $patient->id }}" {{ $medicalRecord->patient_id == $patient->id ? 'selected' : '' }}>
                                                        {{ $patient->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="diagnosis">@lang('Diagnosis')</label>
                                            <textarea name="diagnosis" id="diagnosis" class="form-control" required>{{ $medicalRecord->diagnosis }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="notes">@lang('Notes')</label>
                                            <textarea name="notes" id="notes" class="form-control">{{ $medicalRecord->notes }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="attachment">@lang('Attachment')</label>
                                            <input type="file" name="attachment" id="attachment" class="form-control">
                                            @if ($medicalRecord->attachment)
                                                <p class="mt-2">
                                                    <a href="{{ asset('storage/' . $medicalRecord->attachment) }}" target="_blank">@lang('View Current Attachment')</a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Tab 2: Prescription Info -->
                                    <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                                        <div class="form-group">
                                            <label for="medicines">@lang('Medicines')</label>
                                            <select name="medicines[]" id="medicines" class="form-control" multiple required>
                                                @foreach($medicines as $medicine)
                                                    <option value="{{ $medicine->id }}" {{ in_array($medicine->id, $medicalRecord->medicines->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                        {{ $medicine->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- تفاصيل الأدوية -->
                                        <div id="medicine-details">
                                            @foreach($medicalRecord->medicines as $medicine)
                                                <div class="medicine-detail" id="medicine-{{ $medicine->id }}">
                                                    <label>@lang('Medicine'):</label>
                                                    <input type="text" class="form-control" value="{{ $medicine->name }}" disabled><br>

                                                    <label>@lang('Dosage (times per day)'):</label>
                                                    <input type="number" name="dosage[{{ $medicine->id }}][times]" class="form-control" value="{{ $medicine->pivot->dosage_times }}" required><br>

                                                    <label>@lang('Duration (days)'):</label>
                                                    <input type="number" name="dosage[{{ $medicine->id }}][days]" class="form-control" value="{{ $medicine->pivot->duration_days }}" required><br>

                                                    <label>@lang('Time of medicine intake'):</label>
                                                    <input type="time" name="dosage[{{ $medicine->id }}][time]" class="form-control" value="{{ $medicine->pivot->time_of_intake }}" required><br>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">@lang('Update')</button>
                                <a href="{{ route('Clinic.medical_records.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const medicineSelect = document.getElementById('medicines');
        const medicineDetailsContainer = document.getElementById('medicine-details');

        medicineSelect.addEventListener('change', function () {
            const selectedMedicines = Array.from(this.selectedOptions).map(option => option.value);
            medicineDetailsContainer.innerHTML = ''; // Reset the details container

            selectedMedicines.forEach(medicineId => {
                const medicineDetailHTML = `
                    <div class="medicine-detail" id="medicine-${medicineId}">
                        <label>@lang('Medicine'):</label>
                        <input type="text" class="form-control" value="${medicineId}" disabled><br>

                        <label>@lang('Dosage (times per day)'):</label>
                        <input type="number" name="dosage[${medicineId}][times]" class="form-control" required><br>

                        <label>@lang('Duration (days)'):</label>
                        <input type="number" name="dosage[${medicineId}][days]" class="form-control" required><br>

                        <label>@lang('Time of medicine intake'):</label>
                        <input type="time" name="dosage[${medicineId}][time]" class="form-control" required><br>
                    </div>
                `;
                medicineDetailsContainer.insertAdjacentHTML('beforeend', medicineDetailHTML);
            });
        });
    });
</script>

@endsection
