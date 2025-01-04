@extends('Admin.layouts.app')

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
    <h1>Manage Permissions</h1>

    <!-- Button to Add New Permission -->
    <a href="{{ route('Admin.permissions.create') }}" class="btn btn-primary mb-3">Add New Permission</a>

    <!-- Table to Display Permissions -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Permission Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <!-- Edit and Delete Actions -->
                        <a href="{{ route('Admin.permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <!-- Delete Permission -->
                        <form action="{{ route('Admin.permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
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
