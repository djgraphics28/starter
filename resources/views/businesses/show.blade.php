@extends('layouts.app')

@section('title', $business->name)

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <img src="{{ $business->getFirstMediaUrl('business-logo') }}" alt="{{ $business->name }} logo"
                            class="img-fluid mr-3" style="max-width: 75px;">
                        <h1 class="m-0">{{ $business->name }}</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('businesses.index') }}">Businesses</a></li>
                        <li class="breadcrumb-item active">{{ $business->name }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-employees-tab" data-toggle="pill" href="#v-pills-employees"
                            role="tab" aria-controls="v-pills-employees" aria-selected="true">Employees <span
                                class="badge badge-success float-right">{{ $employees_count ?? 0 }}</span></a>
                        <a class="nav-link" id="v-pills-attendances-tab" data-toggle="pill" href="#v-pills-attendances"
                            role="tab" aria-controls="v-pills-attendances" aria-selected="false">Attendances</a>
                        <a class="nav-link" id="v-pills-payroll-tab" data-toggle="pill" href="#v-pills-payroll"
                            role="tab" aria-controls="v-pills-payroll" aria-selected="false">Payroll</a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="tab-content" id="v-pills-tabContent">
                        <!-- Employees Tab -->
                        <div class="tab-pane fade show active" id="v-pills-employees" role="tabpanel"
                            aria-labelledby="v-pills-employees-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Employee Lists</h3>
                                </div>
                                <div class="card-body">
                                    <table id="employees-table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Position</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            @push('scripts')
                                <script>
                                    $(function() {
                                        $('#employees-table').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: "{{ route('businesses.index', $business->id) }}",
                                            columns: [{
                                                    data: 'id',
                                                    name: 'id'
                                                },
                                                {
                                                    data: 'name',
                                                    name: 'name'
                                                },
                                                {
                                                    data: 'email',
                                                    name: 'email'
                                                },
                                                {
                                                    data: 'phone',
                                                    name: 'phone'
                                                },
                                                {
                                                    data: 'position',
                                                    name: 'position'
                                                },
                                                {
                                                    data: 'status',
                                                    name: 'status'
                                                },
                                                {
                                                    data: 'actions',
                                                    name: 'actions',
                                                    orderable: false,
                                                    searchable: false
                                                }
                                            ]
                                        });
                                    });
                                </script>
                            @endpush
                        </div>

                        <!-- Attendances Tab -->
                        <div class="tab-pane fade" id="v-pills-attendances" role="tabpanel"
                            aria-labelledby="v-pills-attendances-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Attendance Configuration</h3>
                                </div>
                                <div class="card-body">
                                    <form action="#" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label>Check In Time</label>
                                            <input type="text" class="form-control" name="check_in_time">
                                        </div>
                                        <div class="form-group">
                                            <label>Check Out Time</label>
                                            <input type="text" class="form-control" name="check_out_time">
                                        </div>
                                        <div class="form-group">
                                            <label>Late Tolerance (minutes)</label>
                                            <input type="text" class="form-control" name="late_tolerance">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Payroll Tab -->
                        <div class="tab-pane fade" id="v-pills-payroll" role="tabpanel"
                            aria-labelledby="v-pills-payroll-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Payroll Configuration</h3>
                                </div>
                                <div class="card-body">
                                    <form action="#" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label>Pay Period</label>
                                            <input type="text" class="form-control" name="pay_period">
                                        </div>
                                        <div class="form-group">
                                            <label>Basic Salary</label>
                                            <input type="text" class="form-control" name="basic_salary">
                                        </div>
                                        <div class="form-group">
                                            <label>Overtime Rate</label>
                                            <input type="text" class="form-control" name="overtime_rate">
                                        </div>
                                        <div class="form-group">
                                            <label>Tax Rate (%)</label>
                                            <input type="text" class="form-control" name="tax_rate">
                                        </div>
                                        <div class="form-group">
                                            <label>Insurance Deduction</label>
                                            <input type="text" class="form-control" name="insurance_deduction">
                                        </div>
                                        <div class="form-group">
                                            <label>Other Allowances</label>
                                            <input type="text" class="form-control" name="other_allowances">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
