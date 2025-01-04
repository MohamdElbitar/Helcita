@extends('Admin.layouts.app')

@section('title', __('Edit Subscription Type'))

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">@lang('Edit Subscription Type')</h4>

                            <form method="POST" action="{{ route('Admin.subscriptionTypes.update', $subscriptionType->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" name="name" class="form-control" value="{{ $subscriptionType->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label>@lang('Duration Unit')</label>
                                    <select name="duration_unit" class="form-control" required>
                                        <option value="day" {{ $subscriptionType->duration_unit === 'day' ? 'selected' : '' }}>@lang('Day')</option>
                                        <option value="month" {{ $subscriptionType->duration_unit === 'month' ? 'selected' : '' }}>@lang('Month')</option>
                                        <option value="year" {{ $subscriptionType->duration_unit === 'year' ? 'selected' : '' }}>@lang('Year')</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('Duration Value')</label>
                                    <input type="number" name="duration_value" class="form-control" value="{{ $subscriptionType->duration_value }}" required>
                                </div>

                                <div class="form-group">
                                    <label>@lang('Value')</label>
                                    <input type="number" name="value" class="form-control" value="{{ $subscriptionType->value }}" required>
                                </div>

                                <div class="form-group">
                                    <label>@lang('Discount')</label>
                                    <input type="number" name="discount" class="form-control" step="0.01" value="{{ $subscriptionType->discount }}">
                                </div>

                                <button type="submit" class="btn btn-primary">@lang('Update')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
