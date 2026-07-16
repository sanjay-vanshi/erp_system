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

<div class="bg-dark text-white p-3" style="width: 270px; min-height:100vh;">


    <h4 class="text-center mb-4">
        ERP System
    </h4>


    <!-- Dashboard -->

    <a href="{{ route('dashboard') }}"
       class="text-white d-block mb-3 text-decoration-none">

        🏠 Dashboard

    </a>



    <div class="accordion accordion-flush"
         id="sidebarAccordion">



        <!-- Organization Management -->

        @if(
            Auth::user()->hasPermission('view departments') ||
            Auth::user()->hasPermission('view designations') ||
            Auth::user()->hasPermission('view employees')
        )

        <div class="accordion-item bg-dark">


            <h2 class="accordion-header">


                <button class="accordion-button collapsed bg-dark text-white shadow-none px-0"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#organizationMenu">

                    🏢 Organization Management

                </button>


            </h2>



            <div id="organizationMenu"
                 class="accordion-collapse collapse"
                 data-bs-parent="#sidebarAccordion">


                <div class="accordion-body bg-dark p-2">


                    @if(Auth::user()->hasPermission('view departments'))

                    <a href="{{ route('departments.index') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        🏢 Departments

                    </a>

                    @endif



                    @if(Auth::user()->hasPermission('view designations'))

                    <a href="{{ route('designations.index') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        🎯 Designations

                    </a>

                    @endif



                    @if(Auth::user()->hasPermission('view employees'))

                    <a href="{{ route('employees.index') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        👨‍💼 Employees

                    </a>

                    @endif


                </div>


            </div>


        </div>

        @endif





        <!-- HR Management -->

        @if(
            Auth::user()->hasPermission('view attendances') ||
            Auth::user()->hasPermission('view leaves') ||
            Auth::user()->hasPermission('view holidays')||
            Auth::user()->hasPermission('view attendances') ||
            Auth::user()->hasPermission('view leaves') ||
            Auth::user()->hasPermission('view holidays') ||
            Auth::user()->hasPermission('view employee documents')
        )

        <div class="accordion-item bg-dark">


            <h2 class="accordion-header">


                <button class="accordion-button collapsed bg-dark text-white shadow-none px-0"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#hrMenu">


                    👥 HR Management


                </button>


            </h2>



            <div id="hrMenu"
                 class="accordion-collapse collapse"
                 data-bs-parent="#sidebarAccordion">


                <div class="accordion-body bg-dark p-2">


                    @if(Auth::user()->hasPermission('view attendances'))

                    <a href="{{ route('attendances.index') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        🕒 Attendance

                    </a>

                    @endif



                    @if(Auth::user()->hasPermission('view leaves'))

                    <a href="{{ route('leaves.index') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        📅 Leaves

                    </a>

                    @endif

                    @if(Auth::user()->hasPermission('view holidays'))

                      <a href="{{ route('holidays.index') }}"
                    class="text-white d-block mb-2 text-decoration-none">

                                🎉 Holidays

</a>

@endif
{{-- employee documents --}}
@if(Auth::user()->hasPermission('view employee documents'))

<a href="{{ route('employee-documents.index') }}"
class="text-white d-block mb-2 text-decoration-none">

📁 Employee Documents

</a>

@endif


                </div>


            </div>


        </div>

        @endif





        <!-- Finance Management -->

        @if(Auth::user()->hasPermission('view payrolls'))

        <div class="accordion-item bg-dark">


            <h2 class="accordion-header">


                <button class="accordion-button collapsed bg-dark text-white shadow-none px-0"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#financeMenu">


                    💰 Finance Management


                </button>


            </h2>



            <div id="financeMenu"
                 class="accordion-collapse collapse"
                 data-bs-parent="#sidebarAccordion">


                <div class="accordion-body bg-dark p-2">


                    <a href="{{ route('payrolls.index') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        💰 Payroll

                    </a>


                </div>


            </div>


        </div>

        @endif





        <!-- Administration -->

        @if(
            Auth::user()->hasPermission('view users') ||
            Auth::user()->hasPermission('view roles') ||
            Auth::user()->hasPermission('view permissions') ||
            Auth::user()->hasPermission('view activity logs')
        )

        <div class="accordion-item bg-dark">


            <h2 class="accordion-header">


                <button class="accordion-button collapsed bg-dark text-white shadow-none px-0"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#adminMenu">


                    🔐 Administration


                </button>


            </h2>



            <div id="adminMenu"
                 class="accordion-collapse collapse"
                 data-bs-parent="#sidebarAccordion">


                <div class="accordion-body bg-dark p-2">


                    @if(Auth::user()->hasPermission('view users'))

                    <a href="{{ route('users.index') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        👤 Users

                    </a>

                    @endif



                    @if(Auth::user()->hasPermission('view roles'))

                    <a href="{{ route('roles.index') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        🔐 Roles

                    </a>

                    @endif



                    @if(Auth::user()->hasPermission('view permissions'))

                    <a href="{{ route('permissions.index') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        🛡 Permissions

                    </a>

                    @endif



                    @if(Auth::user()->hasPermission('view activity logs'))

                    <a href="{{ route('activity-logs.index') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        📋 Activity Logs

                    </a>

                    @endif


                </div>


            </div>


        </div>

        @endif





        <!-- Reports -->

        @if(Auth::user()->hasPermission('view reports'))

        <div class="accordion-item bg-dark">


            <h2 class="accordion-header">


                <button class="accordion-button collapsed bg-dark text-white shadow-none px-0"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#reportsMenu">


                    📊 Reports


                </button>


            </h2>



            <div id="reportsMenu"
                 class="accordion-collapse collapse"
                 data-bs-parent="#sidebarAccordion">


                <div class="accordion-body bg-dark p-2">


                    <a href="{{ route('reports.employees') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        👨‍💼 Employee Report

                    </a>


                    <a href="{{ route('reports.attendance') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        🕒 Attendance Report

                    </a>


                    <a href="{{ route('reports.leaves') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        📅 Leave Report

                    </a>


                    <a href="{{ route('reports.payroll') }}"
                       class="text-white d-block mb-2 text-decoration-none">

                        💰 Payroll Report

                    </a>


                </div>


            </div>


        </div>

        @endif


    </div>


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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>