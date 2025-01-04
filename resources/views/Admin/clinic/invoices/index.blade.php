@extends('Admin.layouts.app')

@section('title', 'Invoices')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Invoices</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Stexo</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Invoices</a></li>
                        </ol>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h3 class="card-title">Invoice List</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Clinic Name</th>
                                            <th>Subscription</th>
                                            <th>Amount</th>
                                            <th>Discount</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->clinic->name }}</td>
                                            <td>{{ $invoice->subscription->subscriptionTypeData->name }}</td>
                                            <td>${{ number_format($invoice->amount, 2) }}</td>
                                            <td>${{ number_format($invoice->discount, 2) }}</td>
                                            <td>{{ ucfirst($invoice->status) }}</td>
                                            <td>{{ $invoice->created_at->format('F d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('Admin.invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('Admin.invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('Admin.invoices.destroy', $invoice->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
