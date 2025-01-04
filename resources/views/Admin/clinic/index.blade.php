@extends('Admin.layouts.app')

@section('title', __('Clinics'))

@section('content')

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">@lang('Clinics')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Helcita')</a></li>
                            <li class="breadcrumb-item active">@lang('Clinics')</li>
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

                            <!-- Button to Add New Clinic -->
                            <a href="{{ route('Admin.Subscribers.create') }}" class="btn btn-success mb-3">@lang('Add New Clinic')</a>

                            <h4 class="mt-0 header-title">@lang('Clinic List')</h4>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Mobile')</th>
                                        <th>@lang('Address')</th>
                                        <th>@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clinics as $clinic)
                                        <tr>
                                            <td>{{ $clinic->userData->name }}</td>
                                            <td>{{ $clinic->mobile }}</td>
                                            <td>{{ $clinic->address }}</td>
                                            <td>
                                                <a href="{{ route('Admin.Subscribers.show', $clinic->id) }}" class="btn btn-info btn-sm">@lang('View')</a>
                                                <a href="{{ route('Admin.Subscribers.edit', $clinic->id) }}" class="btn btn-primary btn-sm">@lang('Edit')</a>
                                                <form action="{{ route('Admin.Subscribers.destroy', $clinic->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">@lang('Delete')</button>
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
