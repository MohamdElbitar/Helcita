@extends('Admin.layouts.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Invoice</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">
                                        <h4 class="float-right font-16"><strong>Invoice #{{ $invoice->id }}</strong></h4>
                                        <h3 class="m-t-0">
                                            {{-- <img src="{{ asset('assets/images/logo-dark.png') }}" alt="logo" height="24"/> --}}
                                            @lang('Helcita')
                                        </h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <address>
                                                <strong>Billed To:</strong><br>
                                                {{ $invoice->clinic->name }}<br>
                                                {{ $invoice->clinic->address }}<br>
                                                {{ $invoice->clinic->mobile }}
                                            </address>
                                        </div>
                                        <div class="col-6 text-right">
                                            <address>
                                                <strong>Shipped To:</strong><br>
                                                {{ $invoice->clinic->name }}<br>
                                                {{ $invoice->clinic->address }}<br>
                                                {{ $invoice->clinic->mobile }}
                                            </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 m-t-30">
                                            <address>
                                                <strong>Payment Method:</strong><br>
                                                {{ $invoice->payment_method }}<br>
                                                {{ $invoice->email }}
                                            </address>
                                        </div>
                                        <div class="col-6 m-t-30 text-right">
                                            <address>
                                                <strong>Order Date:</strong><br>
                                                {{ $invoice->created_at->format('F j, Y') }}<br><br>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="panel panel-default">
                                        <div class="p-2">
                                            <h3 class="panel-title font-20"><strong>Invoice Summary</strong></h3>
                                        </div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <td><strong>Item</strong></td>
                                                            <td class="text-center"><strong>Price</strong></td>
                                                            <td class="text-center"><strong>Quantity</strong></td>
                                                            <td class="text-right"><strong>Totals</strong></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line text-center">
                                                                <strong>Subtotal</strong>
                                                            </td>
                                                            <td class="thick-line text-right">${{ number_format($invoice->amount, 2) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line text-center">
                                                                <strong>Discount</strong>
                                                            </td>
                                                            <td class="no-line text-right">${{ number_format($invoice->discount, 2) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line text-center">
                                                                <strong>Total</strong>
                                                            </td>
                                                            @php
                                                            // حساب الخصم
                                                            $discountAmount = $invoice->amount * ($invoice->discount / 100);
                                                            // المجموع بعد الخصم
                                                            $finalAmount = $invoice->amount - $discountAmount;
                                                        @endphp

                                                        <td class="no-line text-right"><h4 class="m-0">${{ number_format($finalAmount, 2) }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="d-print-none mo-mt-2">
                                                <div class="float-right">
                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i> Print</a>
                                                    <a href="" class="btn btn-primary waves-effect waves-light">Send</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end row -->

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>


</div>
@endsection
