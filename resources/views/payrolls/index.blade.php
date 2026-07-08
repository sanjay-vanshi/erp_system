@extends('layouts.erp')

@section('content')

@include('partials.alert')



<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Payroll List</h2>

        <a href="{{ route('payrolls.create') }}" class="btn btn-primary">
            Add Payroll
        </a>
    </div>


    {{-- Search & Filter --}}
    <form method="GET" action="{{ route('payrolls.index') }}" class="row g-3 mb-4">

        <div class="col-md-4">
            <input 
                type="text"
                name="search"
                class="form-control"
                placeholder="Search employee..."
                value="{{ request('search') }}"
            >
        </div>


        <div class="col-md-3">
            <input 
                type="month"
                name="payroll_month"
                class="form-control"
                value="{{ request('payroll_month') }}"
            >
        </div>


        <div class="col-md-3">

            <select name="payment_status" class="form-select">

                <option value="">All Status</option>

                <option value="Pending"
                    {{ request('payment_status') == 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="Paid"
                    {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>
                    Paid
                </option>

            </select>

        </div>


        <div class="col-md-2">

            <button class="btn btn-primary">
                Filter
            </button>

            <a href="{{ route('payrolls.index') }}" 
               class="btn btn-secondary">
                Reset
            </a>

        </div>

    </form>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif



    {{-- Payroll Table --}}

    <div class="table-responsive">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee</th>
                    <th>Payroll Month</th>
                    <th>Basic Salary</th>
                    <th>Net Salary</th>
                    <th>Status</th>
                    <th>Payment Date</th>
                    <th width="180">Action</th>
                </tr>
            </thead>


            <tbody>

            @forelse($payrolls as $payroll)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>


                    <td>
                        {{ $payroll->employee->first_name }}
                        {{ $payroll->employee->last_name }}

                        <br>

                        <small>
                            {{ $payroll->employee->employee_code }}
                        </small>
                    </td>


                    <td>
                        {{ \Carbon\Carbon::parse($payroll->payroll_month)->format('F Y') }}
                    </td>


                    <td>
                        ₹ {{ number_format($payroll->basic_salary, 2) }}
                    </td>


                    <td>
                        ₹ {{ number_format($payroll->net_salary, 2) }}
                    </td>


                    <td>

                        @if($payroll->payment_status == 'Paid')

                            <span class="badge bg-success">
                                Paid
                            </span>

                        @else

                            <span class="badge bg-warning">
                                Pending
                            </span>

                        @endif

                    </td>


                    <td>
                        {{ $payroll->payment_date 
                            ? \Carbon\Carbon::parse($payroll->payment_date)->format('d M Y')
                            : '-' 
                        }}
                    </td>


                    <td>

                        <a href="{{ route('payrolls.show', $payroll) }}"
                           class="btn btn-info btn-sm">
                            View
                        </a>


                        <a href="{{ route('payrolls.edit', $payroll) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>


                        <form action="{{ route('payrolls.destroy', $payroll) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                                Delete
                            </button>

                        </form>


                    </td>

                </tr>


            @empty

                <tr>
                    <td colspan="8" class="text-center">
                        No payroll records found.
                    </td>
                </tr>

            @endforelse


            </tbody>

        </table>

    </div>


    {{-- Pagination --}}

    {{ $payrolls->links() }}


</div>

@endsection