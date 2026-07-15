@extends('layouts.erp')


@section('content')


<div class="d-flex justify-content-between align-items-center mb-4">

    <h3>
        📊 Reports Dashboard
    </h3>

</div>



<div class="row g-4">



    <!-- Employee Report -->

    <div class="col-md-3">

        <div class="card shadow-sm h-100">

            <div class="card-body text-center">


                <h1>
                    👨‍💼
                </h1>


                <h5>
                    Employee Report
                </h5>


                <p class="text-muted">
                    View employee details,
                    department and designation information.
                </p>



                <a href="{{ route('reports.employees') }}"
                   class="btn btn-primary">

                    View Report

                </a>


            </div>

        </div>

    </div>






    <!-- Attendance Report -->


    <div class="col-md-3">


        <div class="card shadow-sm h-100">


            <div class="card-body text-center">


                <h1>
                    🕒
                </h1>


                <h5>
                    Attendance Report
                </h5>


                <p class="text-muted">

                    Analyze employee attendance
                    records.

                </p>


                <a href="{{ route('reports.attendance') }}"
                   class="btn btn-success">

                    View Report

                </a>


            </div>


        </div>


    </div>






    <!-- Leave Report -->


    <div class="col-md-3">


        <div class="card shadow-sm h-100">


            <div class="card-body text-center">


                <h1>
                    📅
                </h1>


                <h5>
                    Leave Report
                </h5>


                <p class="text-muted">

                    View leave requests,
                    approvals and status.

                </p>



                <a href="{{ route('reports.leaves') }}"
                   class="btn btn-warning">

                    View Report

                </a>


            </div>


        </div>


    </div>







    <!-- Payroll Report -->


    <div class="col-md-3">


        <div class="card shadow-sm h-100">


            <div class="card-body text-center">


                <h1>
                    💰
                </h1>


                <h5>
                    Payroll Report
                </h5>


                <p class="text-muted">

                    Analyze salary,
                    deductions and payments.

                </p>


                <a href="{{ route('reports.payroll') }}"
                   class="btn btn-danger">

                    View Report

                </a>


            </div>


        </div>


    </div>




</div>



@endsection