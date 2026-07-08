@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            Payroll Details
        </h2>

        <a href="{{ route('payrolls.index') }}" 
           class="btn btn-secondary">
            Back
        </a>

    </div>


    {{-- Employee Information --}}

    <div class="card mb-4">

        <div class="card-header">
            Employee Information
        </div>


        <div class="card-body">

            <div class="row">

                <div class="col-md-4">
                    <strong>Employee Code:</strong>
                    {{ $payroll->employee->employee_code }}
                </div>


                <div class="col-md-4">
                    <strong>Name:</strong>
                    {{ $payroll->employee->first_name }}
                    {{ $payroll->employee->last_name }}
                </div>


                <div class="col-md-4">
                    <strong>Department:</strong>
                    {{ $payroll->employee->department->name }}
                </div>


                <div class="col-md-4 mt-3">

                    <strong>Designation:</strong>
                    {{ $payroll->employee->designation->title }}

                </div>


                <div class="col-md-4 mt-3">

                    <strong>Payroll Month:</strong>

                    {{ \Carbon\Carbon::parse($payroll->payroll_month)->format('F Y') }}

                </div>


                <div class="col-md-4 mt-3">

                    <strong>Status:</strong>

                    @if($payroll->payment_status == 'Paid')

                        <span class="badge bg-success">
                            Paid
                        </span>

                    @else

                        <span class="badge bg-warning">
                            Pending
                        </span>

                    @endif

                </div>


            </div>

        </div>

    </div>



    {{-- Salary Details --}}

    <div class="card mb-4">

        <div class="card-header">
            Salary Details
        </div>


        <div class="card-body">


            <table class="table table-bordered">

                <tr>
                    <th width="50%">
                        Basic Salary
                    </th>

                    <td>
                        ₹ {{ number_format($payroll->basic_salary, 2) }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Allowance
                    </th>

                    <td>
                        ₹ {{ number_format($payroll->allowance, 2) }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Bonus
                    </th>

                    <td>
                        ₹ {{ number_format($payroll->bonus, 2) }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Overtime
                    </th>

                    <td>
                        ₹ {{ number_format($payroll->overtime, 2) }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Deduction
                    </th>

                    <td>
                        ₹ {{ number_format($payroll->deduction, 2) }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Leave Deduction
                    </th>

                    <td>
                        ₹ {{ number_format($payroll->leave_deduction, 2) }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Tax
                    </th>

                    <td>
                        ₹ {{ number_format($payroll->tax, 2) }}
                    </td>
                </tr>


                <tr class="table-success">

                    <th>
                        Net Salary
                    </th>


                    <td>
                        <strong>
                            ₹ {{ number_format($payroll->net_salary, 2) }}
                        </strong>
                    </td>

                </tr>


            </table>


        </div>

    </div>



    {{-- Payment Information --}}

    <div class="card mb-4">


        <div class="card-header">
            Payment Information
        </div>


        <div class="card-body">


            <div class="row">


                <div class="col-md-6">

                    <strong>
                        Payment Date:
                    </strong>


                    {{ $payroll->payment_date 
                        ? \Carbon\Carbon::parse($payroll->payment_date)->format('d M Y')
                        : '-'
                    }}

                </div>


                <div class="col-md-6">

                    <strong>
                        Remarks:
                    </strong>


                    {{ $payroll->remarks ?? '-' }}

                </div>


            </div>


        </div>


    </div>



</div>


@endsection