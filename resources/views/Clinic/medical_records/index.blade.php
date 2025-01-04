@extends('Admin.layouts.app')

@section('title', __('Medical Records'))

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Medical Records')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item active">@lang('Medical Records')</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Success/Error Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <!-- Button to Add New Medical Record -->
                            <a href="{{ route('Clinic.medical_records.create') }}" class="btn btn-success mb-3">@lang('Add New Medical Record')</a>

                            <h4 class="mt-0 header-title">@lang('Medical Records List')</h4>

                            <!-- Table displaying medical records -->
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>@lang('ID')</th>
                                        <th>@lang('Patient Name')</th>
                                        <th>@lang('Diagnosis')</th>
                                        <th>@lang('Prescriptions')</th>
                                        <th>@lang('Notes')</th>
                                        <th>@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($medicalRecords as $record)
                                        <tr>
                                            <td>{{ $record->id }}</td>
                                            <td>{{ $record->patient->name }}</td>
                                            <td>{{ $record->diagnosis }}</td>
                                            <td>{{ $record->prescriptions }}</td>
                                            <td>{{ $record->notes }}</td>
                                            <td>
                                                <!-- View Medical Record Button -->
                                                <a href="{{ route('Clinic.medical_records.show', $record->id) }}" class="btn btn-info btn-sm">@lang('View')</a>

                                                <!-- Edit Medical Record Button -->
                                                <a href="{{ route('Clinic.medical_records.edit', $record->id) }}" class="btn btn-warning btn-sm">@lang('Edit')</a>

                                                <!-- Delete Medical Record Form -->
                                                <form action="{{ route('Clinic.medical_records.destroy', $record->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('@lang('Are you sure you want to delete this record?')')">@lang('Delete')</button>
                                                </form>
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
