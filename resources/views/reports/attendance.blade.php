@extends('layouts.erp')


@section('content')

<a href="{{ route('reports.attendance.export', request()->query()) }}"
   class="btn btn-success">

    Export Excel

</a>
<a href="{{ route('reports.attendance.pdf', request()->query()) }}"
   class="btn btn-danger">
    Export PDF
</a>
<h3 class="mb-4">
    Attendance Report
</h3>



<div class="card mb-4">

<div class="card-body">


<form method="GET"
action="{{ route('reports.attendance') }}">


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


<option value="present"
@if(request('status')=='present')
selected
@endif
>

Present

</option>



<option value="absent"
@if(request('status')=='absent')
selected
@endif
>

Absent

</option>



<option value="leave"
@if(request('status')=='leave')
selected
@endif
>

Leave

</option>


</select>


</div>




<div class="col-md-2">

<input type="month"
name="month"
class="form-control"
value="{{ request('month') }}">

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


<table class="table table-bordered">


<thead>

<tr>

<th>#</th>

<th>Employee</th>

<th>Department</th>

<th>Date</th>

<th>Status</th>

<th>Check In</th>

<th>Check Out</th>


</tr>


</thead>



<tbody>


@forelse($attendances as $attendance)


<tr>


<td>
{{ $loop->iteration }}
</td>


<td>

{{ $attendance->employee->first_name }}
{{ $attendance->employee->last_name }}

</td>


<td>

{{ $attendance->employee->department->name ?? '-' }}

</td>


<td>

{{ $attendance->attendance_date }}

</td>


<td>

{{ ucfirst($attendance->status) }}

</td>


<td>

{{ $attendance->check_in ?? '-' }}

</td>


<td>

{{ $attendance->check_out ?? '-' }}

</td>


</tr>


@empty


<tr>

<td colspan="7"
class="text-center">

No records found.

</td>

</tr>


@endforelse


</tbody>


</table>



{{ $attendances->links() }}


</div>


</div>


@endsection