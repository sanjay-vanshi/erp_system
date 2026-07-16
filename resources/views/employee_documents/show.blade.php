@extends('layouts.erp')

@section('content')

<div class="container">


<div class="d-flex justify-content-between align-items-center mb-3">


<h4>
Employee Document Details
</h4>


<a href="{{ route('employee-documents.index') }}"
class="btn btn-secondary">

Back

</a>


</div>





<div class="card">


<div class="card-body">



<table class="table table-bordered">



<tr>

<th width="200">
Employee
</th>


<td>

{{ $employeeDocument->employee->first_name }}

{{ $employeeDocument->employee->last_name }}


<br>


<small>

{{ $employeeDocument->employee->employee_code }}

</small>


</td>


</tr>





<tr>

<th>
Document Name
</th>


<td>

{{ $employeeDocument->document_name }}

</td>


</tr>





<tr>

<th>
File Name
</th>


<td>

{{ $employeeDocument->file_name }}

</td>


</tr>





<tr>

<th>
Description
</th>


<td>

{{ $employeeDocument->description ?? '-' }}

</td>


</tr>





<tr>

<th>
Uploaded By
</th>


<td>

{{ $employeeDocument->uploader->name ?? '-' }}

</td>


</tr>





<tr>

<th>
Uploaded Date
</th>


<td>

{{ $employeeDocument->created_at->format('d M Y') }}

</td>


</tr>



<tr>

<th>
File
</th>


<td>


<a href="{{ asset('storage/'.$employeeDocument->file_path) }}"
target="_blank"
class="btn btn-success">


Open File


</a>


</td>


</tr>



</table>



</div>


</div>



</div>


@endsection