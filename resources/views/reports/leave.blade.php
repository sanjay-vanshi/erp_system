@extends('layouts.erp')


@section('content')

<a href="{{ route('reports.leaves.export') }}"
   class="btn btn-success">

    Export Excel

</a>
<a href="{{ route('reports.leave.pdf', request()->query()) }}"
   class="btn btn-danger">
    Export PDF
</a>
<h3 class="mb-4">
    Leave Report
</h3>



<div class="card mb-4">


<div class="card-body">


<form method="GET"
action="{{ route('reports.leaves') }}">


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


<select name="status"
class="form-select">


<option value="">
All Status
</option>


<option value="pending"
@if(request('status')=='pending')
selected
@endif
>
Pending
</option>


<option value="approved"
@if(request('status')=='approved')
selected
@endif
>
Approved
</option>


<option value="rejected"
@if(request('status')=='rejected')
selected
@endif
>
Rejected
</option>


</select>


</div>





<div class="col-md-2">


<input type="date"
name="from_date"
class="form-control"
value="{{ request('from_date') }}">


</div>




<div class="col-md-2">


<input type="date"
name="to_date"
class="form-control"
value="{{ request('to_date') }}">


</div>


</div>



<div class="mt-3">

<button class="btn btn-primary">

Filter

</button>


<a href="{{ route('reports.leaves') }}"
class="btn btn-secondary">

Reset

</a>

</div>



</form>


</div>


</div>







<div class="card">


<div class="card-body">


<table class="table table-bordered">


<thead>

<tr>

<th>#</th>

<th>Employee</th>

<th>Department</th>

<th>From</th>

<th>To</th>

<th>Total Days</th>

<th>Status</th>

<th>Approved By</th>


</tr>

</thead>



<tbody>


@forelse($leaves as $leave)


<tr>


<td>
{{ $loop->iteration }}
</td>



<td>

{{ $leave->employee->first_name }}
{{ $leave->employee->last_name }}

</td>



<td>

{{ $leave->employee->department->name ?? '-' }}

</td>



<td>

{{ $leave->from_date }}

</td>



<td>

{{ $leave->to_date }}

</td>



<td>

{{ $leave->total_days }}

</td>



<td>

{{ ucfirst($leave->status) }}

</td>



<td>

{{ $leave->approver->name ?? '-' }}

</td>



</tr>


@empty


<tr>

<td colspan="8"
class="text-center">

No records found.

</td>

</tr>


@endforelse


</tbody>


</table>



{{ $leaves->links() }}



</div>


</div>



@endsection