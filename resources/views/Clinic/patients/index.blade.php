@extends('Admin.layouts.app')

@section('title', __('Patients'))

@section('content')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Patients')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item active">@lang('Patients')</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <!-- Button to Add New Patient -->
                            <a href="{{ route('Clinic.patients.create') }}" class="btn btn-success mb-3">@lang('Add New Patient')</a>

                            <h4 class="mt-0 header-title">@lang('Patient List')</h4>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Phone')</th>
                                        <th>@lang('Address')</th>
                                        <th>@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($patients as $patient)
                                        <tr>
                                            <td>{{ $patient->name }}</td>
                                            <td>{{ $patient->phone }}</td>
                                            <td>{{ $patient->address }}</td>
                                            <td>
                                                <a href="{{ route('Clinic.patients.edit', $patient->id) }}" class="btn btn-primary btn-sm">@lang('Edit')</a>
                                                <form action="{{ route('Clinic.patients.destroy', $patient->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">@lang('Delete')</button>
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
