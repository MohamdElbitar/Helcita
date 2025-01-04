@extends('Admin.layouts.app')

@section('title', __('Financial Records'))

@section('content')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Financial Records')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item active">@lang('Financial Records')</li>
                        </ol>
                    </div>
                </div>
            </div>
 
 <!-- Form to Add Expense -->
 <div class="card m-b-30">
    <div class="card-body">
        <h5>@lang('Add Expense')</h5>
        <form action="{{ route('Clinic.financial.expenses.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="amount">@lang('Amount')</label>
                <input type="number" name="amount" id="amount" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">@lang('Description')</label>
                <input type="text" name="description" id="description" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">@lang('Add Expense')</button>
        </form>
    </div>
</div>

</div>
</div>
</div>

@endsection