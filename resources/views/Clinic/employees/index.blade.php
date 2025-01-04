@extends('Admin.layouts.app')

@section('title', __('Employees'))

@section('content')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Employees')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item active">@lang('Employees')</li>
                        </ol>
                    </div>
                </div>
            </div>
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
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <!-- Button to Add New Employee -->
                            <a href="{{ route('Clinic.employees.create') }}" class="btn btn-success mb-3">@lang('Add New Employee')</a>

                            <h4 class="mt-0 header-title">@lang('Employee List')</h4>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Email')</th>
                                        <th>@lang('Status')</th>
                                        <th>@lang('Permissions')</th>
                                        <th>@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->user->name }}</td>
                                            <td>{{ $employee->user->email }}</td>
                                            <td>{{ $employee->status }}</td>
                                            <td>
                                                @foreach ($employee->permissions as $permission)
                                                    <span class="badge bg-info">{{ $permission->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('Clinic.employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">@lang('Edit')</a>
                                                <form action="{{ route('Clinic.employees.destroy', $employee->id) }}" method="POST" style="display: inline-block;">
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
