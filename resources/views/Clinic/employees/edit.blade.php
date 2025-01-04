@extends('Admin.layouts.app')

@section('title', __('Edit Employee'))

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Edit Employee')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item active">@lang('Edit Employee')</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <form action="{{ route('Clinic.employees.update', $employee->id) }}" method="POST">
                                @csrf
                                @method('PUT')

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
                                    <label for="name">@lang('Employee Name')</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="@lang('Enter Name')" value="{{ old('name', $employee->user->name) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">@lang('Email')</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="@lang('Enter Email')" value="{{ old('email', $employee->user->email) }}" required>
                                </div>
{{-- 
                                <div class="form-group">
                                    <label for="password">@lang('Password')</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="@lang('Enter Password')">
                                </div> --}}

                                <div class="form-group">
                                    <label for="phone">@lang('Phone')</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="@lang('Enter Phone Number')" value="{{ old('phone', $employee->phone) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="status">@lang('Status')</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="active" {{ $employee->status == 'active' ? 'selected' : '' }}>@lang('Active')</option>
                                        <option value="inactive" {{ $employee->status == 'inactive' ? 'selected' : '' }}>@lang('Inactive')</option>
                                    </select>
                                </div>

                                <!-- اختيار الصلاحيات الخاصة بالعيادة -->
                                <div class="form-group">
                                    <label for="permissions">@lang('Permissions')</label>
                                    <select name="permissions[]" id="permissions" class="form-control" multiple required>
                                        @foreach($clinicPermissions as $permission)
                                            <option value="{{ $permission->id }}" 
                                                @if(in_array($permission->id, $employeePermissions)) selected @endif>
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success">@lang('Update')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
