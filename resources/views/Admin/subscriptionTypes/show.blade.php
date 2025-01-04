@extends('Admin.layouts.app')

@section('title', __('View Subscription Type'))

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">@lang('Subscription Type Details')</h4>

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <td>{{ $subscriptionType->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Duration Unit')</th>
                                        <td>@lang(ucfirst($subscriptionType->duration_unit))</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Duration Value')</th>
                                        <td>{{ $subscriptionType->duration_value }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Value')</th>
                                        <td>{{ $subscriptionType->value }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Discount')</th>
                                        <td>{{ $subscriptionType->discount }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Created At')</th>
                                        <td>{{ $subscriptionType->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Updated At')</th>
                                        <td>{{ $subscriptionType->updated_at }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <a href="{{ route('Admin.subscriptionTypes.index') }}" class="btn btn-secondary">@lang('Back to List')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
