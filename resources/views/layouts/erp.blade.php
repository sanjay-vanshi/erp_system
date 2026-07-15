<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ERP System</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">

        <h4 class="text-center mb-4">ERP System</h4>

        <a href="{{ route('dashboard') }}" class="text-white d-block mb-2">
    🏠 Dashboard
</a>

@if(Auth::user()->hasPermission('view departments'))

<a href="{{ route('departments.index') }}"
   class="text-white d-block mb-2">

    🏢 Departments

</a>

@endif

@if(Auth::user()->hasPermission('view designations'))

<a href="{{ route('designations.index') }}"
   class="text-white d-block mb-2">

    🎯 Designations

</a>

@endif

@if(Auth::user()->hasPermission('view employees'))

<a href="{{ route('employees.index') }}"
   class="text-white d-block mb-2">

    👨‍💼 Employees

</a>

@endif

@if(Auth::user()->hasPermission('view attendances'))

<a href="{{ route('attendances.index') }}"
   class="text-white d-block mb-2">

    🕒 Attendance

</a>

@endif

@if(Auth::user()->hasPermission('view leaves'))

<a href="{{ route('leaves.index') }}"
   class="text-white d-block mb-2">

    📅 Leaves

</a>

@endif

@if(Auth::user()->hasPermission('view payrolls'))

<a href="{{ route('payrolls.index') }}"
   class="text-white d-block mb-2">

    💰 Payroll

</a>

@endif

@if(Auth::user()->hasPermission('view roles'))

<a href="{{ route('roles.index') }}"
   class="text-white d-block mb-2">

    🔐 Roles

</a>

@endif

@if(Auth::user()->hasPermission('view users'))

<a href="{{ route('users.index') }}"
   class="text-white d-block mb-2">

    👤 Users

</a>

@endif

@if(Auth::user()->hasPermission('view activity logs'))

<a href="{{ route('activity-logs.index') }}"
   class="text-white d-block mb-2">

    📋 Activity Logs

</a>

@endif
    </div>

    <!-- Page Content -->
    <div class="flex-grow-1">

        <!-- Top Navbar -->
        <nav class="navbar navbar-light bg-light px-3 shadow-sm">

            <span class="navbar-brand">ERP Dashboard</span>

            <div>
                <span class="me-3">{{ auth()->user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-danger">Logout</button>
                </form>
            </div>

        </nav>

        <!-- Main Content -->
        <div class="container-fluid p-4">

            @yield('content')

        </div>

    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const alert = document.querySelector('.alert');

    if (alert) {
        setTimeout(function () {
            alert.remove();
        }, 3000);
    }
});
</script>
</body>
</html>