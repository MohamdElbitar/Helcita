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

            <!-- Display Success or Error Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <!-- Add New Revenue or Expense Button -->
                            <a href="{{ route('Clinic.financial.create') }}" class="btn btn-success mb-3">@lang('Add New Record')</a>

                            <h4 class="mt-0 header-title">@lang('Revenue Records')</h4>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>@lang('Description')</th>
                                        <th>@lang('Amount')</th>
                                        <th>@lang('Date')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($revenueRecords as $record)
                                        <tr>
                                            <td>{{ $record->description }}</td>
                                            <td>{{ $record->amount }} @lang('EG')</td>
                                            <td>{{ $record->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><strong>@lang('Total')</strong></td>
                                        <td><strong>{{ $totalRevenue }} @lang('EG')</strong></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <h4 class="mt-0 header-title">@lang('Expense Records')</h4>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>@lang('Description')</th>
                                        <th>@lang('Amount')</th>
                                        <th>@lang('Date')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expenseRecords as $record)
                                        <tr>
                                            <td>{{ $record->description }}</td>
                                            <td>{{ $record->amount }} @lang('EG')</td>
                                            <td>{{ $record->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><strong>@lang('Total')</strong></td>
                                        <td><strong>{{ $totalExpense }} @lang('EG')</strong></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <!-- New Table for Net Profit (Revenue - Expenses) -->
                            <h4 class="mt-0 header-title">@lang('Net Profit')</h4>

                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>@lang('Total Revenue')</th>
                                        <th>@lang('Total Expenses')</th>
                                        <th>@lang('Net Profit')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $totalRevenue }} @lang('EG')</td>
                                        <td>{{ $totalExpense }} @lang('EG')</td>
                                        <td><strong>{{ $netProfit }} @lang('EG')</strong></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

