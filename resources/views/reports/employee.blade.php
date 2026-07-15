@extends('layouts.erp')


@section('content')
<a href="{{ route('reports.employees.export', request()->query()) }}"
   class="btn btn-success">

    Export Excel

</a>
<a href="{{ route('reports.employee.pdf', request()->query()) }}"
   class="btn btn-danger">
    Export PDF
</a>

<h3 class="mb-4">
    Employee Report
</h3>



<div class="card mb-4">

<div class="card-body">


<form method="GET"
      action="{{ route('reports.employees') }}">


<div class="row g-2">


<div class="col-md-3">

<input type="text"
       name="search"
       class="form-control"
       placeholder="Search employee..."
       value="{{ request('search') }}">


</div>




<div class="col-md-3">

<select name="department_id"
        class="form-select">


<option value="">
All Departments
</option>


@foreach($departments as $department)

<option value="{{ $department->id }}"
@if(request('department_id')==$department->id)
selected
@endif
>

{{ $department->name }}

</option>

@endforeach


</select>


</div>




<div class="col-md-3">

<select name="designation_id"
        class="form-select">


<option value="">
All Designations
</option>


@foreach($designations as $designation)

<option value="{{ $designation->id }}"
@if(request('designation_id')==$designation->id)
selected
@endif
>

{{ $designation->title }}

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


<option value="active"
@if(request('status')=='active')
selected
@endif
>
Active
</option>


<option value="inactive"
@if(request('status')=='inactive')
selected
@endif
>
Inactive
</option>


</select>


</div>




<div class="col-md-1">

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
<th>Employee Code</th>
<th>Name</th>
<th>Department</th>
<th>Designation</th>
<th>Email</th>
<th>Status</th>

</tr>

</thead>



<tbody>


@forelse($employees as $employee)


<tr>

<td>
{{ $loop->iteration }}
</td>


<td>
{{ $employee->employee_code }}
</td>


<td>
{{ $employee->first_name }}
{{ $employee->last_name }}
</td>


<td>
{{ $employee->department->name ?? '-' }}
</td>


<td>
{{ $employee->designation->title ?? '-' }}
</td>


<td>
{{ $employee->email }}
</td>


<td>

{{ ucfirst($employee->status) }}

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



{{ $employees->links() }}


</div>

</div>


@endsection