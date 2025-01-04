@extends('Admin.layouts.app')

@section('title', __('Register Clinic'))

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">@lang('Register New Clinic')</h4>

                            <form method="POST" action="{{ route('Admin.Subscribers.store') }}" enctype="multipart/form-data">
                                @csrf

                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                <!-- User Information -->
                                <div class="row">
                                    <div class="col-4 form-group">
                                        <label for="name">@lang('Name')</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="col-4 form-group">
                                        <label for="email">@lang('Email')</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>

                                    <div class="col-4 form-group">
                                        <label for="password">@lang('Password')</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Clinic Information -->
                                <div class="row">
                                    <div class="col-4 form-group">
                                        <label for="logo">@lang('Logo')</label>
                                        <input type="file" name="logo" class="form-control" required>
                                    </div>

                                    <div class="col-4 form-group">
                                        <label for="mobile">@lang('Mobile')</label>
                                        <input type="text" name="mobile" class="form-control" required>
                                    </div>

                                    <div class="col-4 form-group">
                                        <label for="address">@lang('Address')</label>
                                        <textarea name="address" class="form-control" required></textarea>
                                    </div>
                                </div>

                                <!-- Subscription Information -->
                                <div class="row">
                                    <div class="col-4 form-group">
                                        <label for="subscription_type_id">@lang('Subscription Type')</label>
                                        <select name="subscription_type_id" id="subscription_type_id" class="form-control" required>
                                            @foreach($subscriptionTypes as $type)
                                                <option value="{{ $type->id }}"
                                                    data-start="{{ $type->start_date }}"
                                                    data-end="{{ $type->end_date }}"
                                                    data-amount="{{ $type->amount }}"
                                                    data-discount="{{ $type->discount }}"
                                                    data-status="{{ $type->status }}">
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-4 form-group" style="display:none;">
                                        <label for="start_date">@lang('Start Date')</label>
                                        <input type="date" id="start_date" name="start_date" class="form-control" readonly>
                                    </div>

                                    <div class="col-4 form-group" style="display:none;">
                                        <label for="end_date">@lang('End Date')</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control" readonly>
                                    </div>

                                    <div class="col-4 form-group" style="display:none;">
                                        <label for="amount">@lang('Amount')</label>
                                        <input type="number" id="amount" name="amount" class="form-control" readonly>
                                    </div>

                                    <div class="col-4 form-group" style="display:none;">
                                        <label for="discount">@lang('Discount')</label>
                                        <input type="number" id="discount" name="discount" class="form-control" readonly>
                                    </div>

                                    <div class="col-4 form-group" style="display:none;">
                                        <label for="status">@lang('Status')</label>
                                        <input type="text" id="status" name="status" class="form-control" readonly>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">@lang('Register Clinic')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.getElementById('subscription_type_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const startDate = selectedOption.getAttribute('data-start');
        const endDate = selectedOption.getAttribute('data-end');
        const amount = selectedOption.getAttribute('data-amount');
        const discount = selectedOption.getAttribute('data-discount');
        const status = selectedOption.getAttribute('data-status');

        // Set the hidden fields based on the selected subscription
        document.getElementById('start_date').value = startDate;
        document.getElementById('end_date').value = endDate;
        document.getElementById('amount').value = amount;
        document.getElementById('discount').value = discount;
        document.getElementById('status').value = status;
    });
</script>
@endsection

@endsection
