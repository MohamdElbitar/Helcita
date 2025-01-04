@extends('Admin.layouts.app')

@section('title', __('Edit Clinic'))

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">@lang('Edit Clinic')</h4>

            <form method="POST" action="{{ route('Admin.Subscribers.update', $clinic->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>@lang('Name')</label>
                    <input type="text" name="name" value="{{ $clinic->name }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>@lang('Email')</label>
                    <input type="email" name="email" value="{{ $clinic->user->email }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>@lang('Mobile')</label>
                    <input type="text" name="mobile" value="{{ $clinic->mobile }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>@lang('Address')</label>
                    <input type="text" name="address" value="{{ $clinic->address }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>@lang('Logo')</label>
                    <input type="file" name="logo" class="form-control">
                </div>
                <div class="form-group">
                    <label>@lang('Subscription Type')</label>
                    <select name="subscription_type_id" class="form-control" required>
                        @foreach($subscriptionTypes as $type)
                            <option value="{{ $type->id }}" {{ $clinic->subscriptionData->subscription_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">@lang('Update Clinic')</button>
            </form>
        </div>
    </div>
</div>
@endsection
