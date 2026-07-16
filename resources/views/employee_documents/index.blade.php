@extends('layouts.erp')

@section('content')

@include('partials.alert')


<div class="container">


<div class="d-flex justify-content-between align-items-center mb-3">


<h2>
Employee Documents
</h2>


@if(Auth::user()->hasPermission('create employee documents'))

<a href="{{ route('employee-documents.create') }}"
class="btn btn-primary">

Upload Document

</a>

@endif


</div>





{{-- Search Filter --}}

<form method="GET"
action="{{ route('employee-documents.index') }}"
class="row g-3 mb-4">



<div class="col-md-5">

<input
type="text"
name="search"
class="form-control"

placeholder="Search employee or document..."

value="{{ request('search') }}">


</div>




<div class="col-md-4">


<select name="employee_id"
class="form-select">


<option value="">
All Employees
</option>



@foreach($employees as $employee)


<option value="{{ $employee->id }}"

{{ request('employee_id') == $employee->id ? 'selected':'' }}

>

{{ $employee->employee_code }}
-
{{ $employee->first_name }}
{{ $employee->last_name }}

</option>


@endforeach


</select>


</div>




<div class="col-md-3">


<button class="btn btn-primary">

Filter

</button>


<a href="{{ route('employee-documents.index') }}"
class="btn btn-secondary">

Reset

</a>


</div>



</form>







<div class="table-responsive">


<table class="table table-bordered table-striped">


<thead>

<tr>

<th>#</th>

<th>Employee</th>

<th>Document Name</th>

<th>File</th>

<th>Uploaded By</th>

<th>Date</th>

<th width="220">
Action
</th>


</tr>


</thead>




<tbody>


@forelse($documents as $document)


<tr>


<td>
{{ $loop->iteration }}
</td>



<td>

{{ $document->employee->first_name }}
{{ $document->employee->last_name }}

<br>

<small>
{{ $document->employee->employee_code }}
</small>


</td>




<td>

{{ $document->document_name }}

</td>




<td>

<a href="{{ asset('storage/'.$document->file_path) }}"
target="_blank"
class="btn btn-sm btn-success">

View File

</a>


</td>




<td>

{{ $document->uploader->name ?? '-' }}

</td>




<td>

{{ $document->created_at->format('d-m-Y') }}

</td>




<td>


@if(Auth::user()->hasPermission('view employee documents'))

<a href="{{ route('employee-documents.show',$document) }}"
class="btn btn-info btn-sm">

View

</a>

@endif




@if(Auth::user()->hasPermission('edit employee documents'))

<a href="{{ route('employee-documents.edit',$document) }}"
class="btn btn-warning btn-sm">

Edit

</a>

@endif





@if(Auth::user()->hasPermission('delete employee documents'))

<form action="{{ route('employee-documents.destroy',$document) }}"
method="POST"
class="d-inline">


@csrf

@method('DELETE')


<button
class="btn btn-danger btn-sm"
onclick="return confirm('Delete Document?')">

Delete

</button>


</form>

@endif



</td>


</tr>


@empty


<tr>

<td colspan="7"
class="text-center">

No documents found

</td>

</tr>


@endforelse



</tbody>


</table>


</div>



{{ $documents->links() }}



</div>


@endsection