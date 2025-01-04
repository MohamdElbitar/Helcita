@extends('Admin.layouts.app')

@section('title', __('Subscription Types'))

@section('content')

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Subscription Types')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item active">@lang('Subscription Types')</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">

                            <!-- Button to Add New Subscription Type -->
                            <a href="{{ route('Admin.subscriptionTypes.create') }}" class="btn btn-success mb-3">@lang('Add New Subscription Type')</a>

                            <h4 class="mt-0 header-title">@lang('Subscription Types List')</h4>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Duration')</th>
                                        <th>@lang('Value')</th>
                                        <th>@lang('Discount')</th>
                                        <th>@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subscriptionTypes as $type)
                                        <tr>
                                            <td>{{ $type->name }}</td>
                                            <td>{{ $type->duration_value }} @lang(ucfirst($type->duration_unit))</td>
                                            <td>{{ $type->value }}</td>
                                            <td>{{ $type->discount }}</td>
                                            <td>
                                                <a href="{{ route('Admin.subscriptionTypes.edit', $type->id) }}" class="btn btn-primary btn-sm">@lang('Edit')</a>
                                                <form action="{{ route('Admin.subscriptionTypes.destroy', $type->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('@lang('Are you sure?')')">@lang('Delete')</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->
</div>

@endsection
