@extends('layouts.erp')


@section('content')

<a href="{{ route('reports.payroll.export') }}"
   class="btn btn-success">

    Export Excel

</a>
<a href="{{ route('reports.payroll.pdf', request()->query()) }}"
class="btn btn-danger">

Export PDF

</a>
<h3 class="mb-4">
    Payroll Report
</h3>




<div class="card mb-4">


<div class="card-body">


<form method="GET"
action="{{ route('reports.payroll') }}">


<div class="row g-2">



<div class="col-md-3">

<input type="text"
name="search"
class="form-control"
placeholder="Search employee..."
value="{{ request('search') }}">

</div>




<div class="col-md-3">

<select name="employee_id"
class="form-select">


<option value="">
All Employees
</option>



@foreach($employees as $employee)


<option value="{{ $employee->id }}"
@if(request('employee_id')==$employee->id)
selected
@endif
>


{{ $employee->first_name }}
{{ $employee->last_name }}


</option>


@endforeach


</select>


</div>





<div class="col-md-2">


<input type="month"
name="payroll_month"
class="form-control"
value="{{ request('payroll_month') }}">


</div>





<div class="col-md-2">


<select name="payment_status"
class="form-select">


<option value="">
All Status
</option>


<option value="paid"
@if(request('payment_status')=='paid')
selected
@endif
>
Paid
</option>



<option value="pending"
@if(request('payment_status')=='pending')
selected
@endif
>
Pending
</option>



</select>


</div>





<div class="col-md-2">


<button class="btn btn-primary">

Filter

</button>


</div>


</div>


</form>


</div>


</div>








<div class="card">


<div class="card-body">


<table class="table table-bordered table-striped">


<thead>


<tr>

<th>#</th>

<th>Employee</th>

<th>Department</th>

<th>Month</th>

<th>Basic Salary</th>

<th>Allowances</th>

<th>Deductions</th>

<th>Net Salary</th>

<th>Status</th>


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

</td>



<td>

{{ $payroll->employee->department->name ?? '-' }}

</td>



<td>

{{ \Carbon\Carbon::parse($payroll->payroll_month)->format('M Y') }}

</td>




<td>

{{ number_format($payroll->basic_salary,2) }}

</td>



<td>

{{ number_format($payroll->allowances,2) }}

</td>



<td>

{{ number_format($payroll->deductions,2) }}

</td>



<td>

{{ number_format($payroll->net_salary,2) }}

</td>




<td>

{{ ucfirst($payroll->payment_status) }}

</td>



</tr>



@empty


<tr>

<td colspan="9"
class="text-center">

No records found.

</td>

</tr>


@endforelse



</tbody>


</table>




{{ $payrolls->links() }}



</div>


</div>



@endsection