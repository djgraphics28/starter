@extends('layouts.app')

@section('title', 'Businesses')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Businesses</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Businesses</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="mb-3 float-sm-right">
                <a href="{{ route('businesses.create') }}" class="btn btn-primary">Add Business</a>
            </div>
            @if (count($businesses) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Code</th>
                                <th>Business Name</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($businesses as $business)
                                <tr>
                                    <td>
                                        @if ($business->getFirstMediaUrl('business-logo'))
                                            <img src="{{ $business->getFirstMediaUrl('business-logo') }}"
                                                alt="Business Logo" width="50">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                                fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                <path
                                                    d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
                                            </svg>
                                        @endif
                                    </td>
                                    <td>{{ $business->code }}</td>
                                    <td><a href="{{ route('businesses.show', $business->id) }}"
                                            class="badge badge-primary badge-lg"
                                            title="Click to show more information">{{ $business->name }}</a></td>
                                    <td>{{ $business->contact_number }}</td>
                                    <td>{{ $business->address }}</td>
                                    <td>
                                        <a href="{{ route('businesses.show', $business->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Info</a>
                                        <a href="{{ route('businesses.edit', $business->id) }}" 
                                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        <form action="{{ route('businesses.destroy', $business->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this business?')"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- {{ $businesses->links() }} --}}
            @else
                <div class="alert alert-info">
                    No businesses found.
                    <a href="{{ route('businesses.create') }}" class="btn btn-primary">Add Business</a>
                </div>
            @endif
        </div>
    </div>
@endsection
