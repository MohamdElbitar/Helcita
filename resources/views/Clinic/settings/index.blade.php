@extends('Admin.layouts.app')

@section('title', __('Clinic Settings'))

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Clinic Settings')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item active">@lang('Clinic Settings')</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
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
                           <!-- Display validation errors -->
                           @if ($errors->any())
                           <div class="alert alert-danger">
                               <ul>
                                   @foreach ($errors->all() as $error)
                                       <li>{{ $error }}</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif
                        <h4 class="mt-0 header-title">@lang('Clinic Settings')</h4>
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">
                                    <span class="d-none d-md-block">@lang('Clinic Info')</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab">
                                    <span class="d-none d-md-block">@lang('Security')</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                </a>
                            </li>

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                                <form method="POST" action="{{ route('Clinic.settings.update') }}">
                                    @csrf
                                    @method('PUT')
                                
                                    <div class="form-group">
                                        <label>@lang('Clinic Name')</label>
                                        <input type="text" name="clinic_name" class="form-control" value="{{ old('clinic_name', $clinic->name) }}" required>
                                        @error('clinic_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="form-group">
                                        <label>@lang('Email')</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $clinic->userData->email) }}" required>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="form-group">
                                        <label>@lang('Phone')</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $clinic->mobile) }}" required>
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <button type="submit" class="btn btn-primary">@lang('Save Changes')</button>
                                </form>
                                
                            </div>

                            <!-- Tab for Security -->
                            <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                                <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                                    <form method="POST" action="{{ route('Clinic.settings.update') }}">
                                        @csrf
                                        @method('PUT')
                                
                                        <div class="form-group">
                                            <label>@lang('Current Password')</label>
                                            <input type="password" name="current_password" class="form-control" required>
                                            @error('current_password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                
                                        <div class="form-group">
                                            <label>@lang('New Password')</label>
                                            <input type="password" name="new_password" class="form-control" required>
                                            @error('new_password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                
                                        <div class="form-group">
                                            <label>@lang('Confirm New Password')</label>
                                            <input type="password" name="new_password_confirmation" class="form-control" required>
                                            @error('new_password_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                
                                        <button type="submit" class="btn btn-primary">@lang('Change Password')</button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
