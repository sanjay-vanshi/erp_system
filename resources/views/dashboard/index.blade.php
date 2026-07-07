@extends('layouts.erp')

@section('content')

<div class="container-fluid">

    {{-- Welcome Section --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h4 class="mb-1">Welcome Back, Admin 👋</h4>
            <small class="text-muted">ERP Dashboard Overview</small>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row mb-3">

        <div class="col-md-3">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h6>Departments</h6>
                    <h3>{{ $totalDepartments }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h6>Designations</h6>
                    <h3>{{ $totalDesignations }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <h6>Total Employees</h6>
                    <h3>{{ $totalEmployees }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body">
                    <h6>Inactive Employees</h6>
                    <h3>{{ $inactiveEmployees }}</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- Active Employees --}}
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <h6>Active Employees</h6>
                    <h3>{{ $activeEmployees }}</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- Charts Section --}}
    <div class="row mb-4">

        {{-- Employee Status Pie --}}
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    Employee Status
                </div>
                <div class="card-body">
                    <canvas id="employeeStatusChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Department Bar Chart --}}
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    Department Wise Employees
                </div>
                <div class="card-body">
                    <canvas id="departmentChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    {{-- Trend Chart --}}
    <div class="row mb-4">

        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    Employee Joining Trend
                </div>
                <div class="card-body">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    {{-- Recent Employees --}}
    <div class="card shadow-sm">

        <div class="card-header">
            Recent Employees
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($recentEmployees as $emp)
                        <tr>
                            <td>{{ $emp->id }}</td>
                            <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>
                            <td>{{ $emp->department->name ?? '-' }}</td>
                            <td>{{ $emp->designation->title ?? '-' }}</td>
                            <td>
                                @if($emp->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No Employees Found
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* =======================
   Employee Status Pie
======================= */
new Chart(document.getElementById('employeeStatusChart'), {
    type: 'pie',
    data: {
        labels: ['Active', 'Inactive'],
        datasets: [{
            data: [
                {{ $activeEmployees }},
                {{ $inactiveEmployees }}
            ],
            backgroundColor: ['#28a745', '#dc3545']
        }]
    }
});


/* =======================
   Department Bar Chart
======================= */
new Chart(document.getElementById('departmentChart'), {
    type: 'bar',
    data: {
        labels: @json($departmentWiseEmployees->pluck('name')),
        datasets: [{
            label: 'Employees',
            data: @json($departmentWiseEmployees->pluck('employees_count')),
            backgroundColor: '#0d6efd'
        }]
    }
});


/* =======================
   Employee Trend Line
======================= */
new Chart(document.getElementById('trendChart'), {
    type: 'line',
    data: {
        labels: @json($employeeTrend->pluck('date')),
        datasets: [{
            label: 'Employees Joined',
            data: @json($employeeTrend->pluck('count')),
            borderColor: '#ffc107',
            fill: false
        }]
    }
});
</script>

@endsection