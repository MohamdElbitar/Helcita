@extends('Admin.layouts.app')

@section('title', __('Add Patient'))

@section('content')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Add New Patient')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('Clinic.patients.index') }}">@lang('Patients')</a></li>
                            <li class="breadcrumb-item active">@lang('Add New Patient')</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">

                            <form action="{{ route('Clinic.patients.store') }}" method="POST">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="name">@lang('Name')</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">@lang('Phone')</label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="address">@lang('Address')</label>
                                    <input type="text" name="address" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-success">@lang('Save Patient')</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
