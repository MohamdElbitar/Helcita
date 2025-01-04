@extends('Admin.layouts.app')

@section('title', __('Add Subscription Type'))

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">@lang('Add New Subscription Type')</h4>

                            <!-- Display Validation Errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('Admin.subscriptionTypes.store') }}">
                                @csrf
                                <!-- Name -->
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        value="{{ old('name') }}"
                                        placeholder="@lang('Enter subscription name')"
                                        required>
                                </div>

                                <!-- Duration Unit -->
                                <div class="form-group">
                                    <label>@lang('Duration Unit')</label>
                                    <select
                                        name="duration_unit"
                                        class="form-control"
                                        required>
                                        <option value="day" {{ old('duration_unit') == 'day' ? 'selected' : '' }}>@lang('Day')</option>
                                        <option value="month" {{ old('duration_unit') == 'month' ? 'selected' : '' }}>@lang('Month')</option>
                                        <option value="year" {{ old('duration_unit') == 'year' ? 'selected' : '' }}>@lang('Year')</option>
                                    </select>
                                </div>

                                <!-- Duration Value -->
                                <div class="form-group">
                                    <label>@lang('Duration Value')</label>
                                    <input
                                        type="number"
                                        name="duration_value"
                                        class="form-control"
                                        value="{{ old('duration_value', 1) }}"
                                        placeholder="@lang('Enter duration in units')"
                                        required>
                                </div>

                                <!-- Value -->
                                <div class="form-group">
                                    <label>@lang('Value')</label>
                                    <input
                                        type="number"
                                        name="value"
                                        class="form-control"
                                        value="{{ old('value', 0) }}"
                                        step="0.01"
                                        placeholder="@lang('Enter subscription value')"
                                        required>
                                </div>

                                <!-- Discount -->
                                <div class="form-group">
                                    <label>@lang('Discount')</label>
                                    <input
                                        type="number"
                                        name="discount"
                                        class="form-control"
                                        value="{{ old('discount', 0) }}"
                                        step="0.01"
                                        placeholder="@lang('Enter discount percentage')">
                                </div>

                                <!-- Save Button -->
                                <button type="submit" class="btn btn-primary">@lang('Save')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
