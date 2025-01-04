@extends('Admin.layouts.app')

@section('title', __('Clinic Details'))

@section('content')


<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Clinics')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item active">@lang('Clinics')</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>

            <div class="col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">@lang('Clinic Details')</h4>
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">
                                    <span class="d-none d-md-block">@lang('Basic Details')</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab">
                                    <span class="d-none d-md-block">@lang('Subscription Details')</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                </a>
                            </li>

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <p>{{ $clinic->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Email')</label>
                                    <p>{{ $clinic->userData->email }}</p>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Mobile')</label>
                                    <p>{{ $clinic->mobile }}</p>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Address')</label>
                                    <p>{{ $clinic->address }}</p>
                                </div>
                            </div>
                            <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                                <div class="form-group">
                                    <label>@lang('Subscription Type')</label>
                                    <p>{{ $clinic->subscriptionData->subscriptionTypeData->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Start Date')</label>
                                    <p>{{ $clinic->subscriptionData->start_date }}</p>
                                </div>
                                <div class="form-group">
                                    <label>@lang('End Date')</label>
                                    <p>{{ $clinic->subscriptionData->end_date }}</p>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Amount')</label>
                                    <p>{{ $clinic->subscriptionData->amount }}</p>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Discount')</label>
                                    <p>{{ $clinic->subscriptionData->discount }}</p>
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
