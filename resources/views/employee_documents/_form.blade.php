@if(isset($employeeDocument))


<form action="{{ route('employee-documents.update',$employeeDocument) }}"
method="POST"
enctype="multipart/form-data">


@method('PUT')


@else


<form action="{{ route('employee-documents.store') }}"
method="POST"
enctype="multipart/form-data">


@endif


@csrf



{{-- Employee --}}

<div class="mb-3">

<label class="form-label">
    Employee
</label>


<select 
name="employee_id"
class="form-select @error('employee_id') is-invalid @enderror">


<option value="">
Select Employee
</option>



@foreach($employees as $employee)


<option value="{{ $employee->id }}"

{{ old('employee_id',$employeeDocument->employee_id ?? '') == $employee->id ? 'selected':'' }}

>

{{ $employee->employee_code }}
-
{{ $employee->first_name }}
{{ $employee->last_name }}


</option>


@endforeach


</select>


@error('employee_id')

<div class="text-danger mt-1">
{{ $message }}
</div>

@enderror


</div>





{{-- Document Name --}}

<div class="mb-3">

<label class="form-label">
Document Name
</label>


<input
type="text"
name="document_name"
class="form-control @error('document_name') is-invalid @enderror"

value="{{ old('document_name',$employeeDocument->document_name ?? '') }}"

placeholder="Enter Document Name">


@error('document_name')

<div class="text-danger mt-1">
{{ $message }}
</div>

@enderror


</div>





{{-- File --}}

<div class="mb-3">

<label class="form-label">
Upload File
</label>


<input
type="file"
name="file"
class="form-control @error('file') is-invalid @enderror">


@if(isset($employeeDocument))

<small class="text-muted">

Current File:
{{ $employeeDocument->file_name }}

</small>

@endif


@error('file')

<div class="text-danger mt-1">
{{ $message }}
</div>

@enderror


</div>





{{-- Description --}}

<div class="mb-3">


<label class="form-label">
Description
</label>


<textarea
name="description"
rows="4"
class="form-control @error('description') is-invalid @enderror"

placeholder="Enter Description">{{ old('description',$employeeDocument->description ?? '') }}</textarea>



@error('description')

<div class="text-danger mt-1">
{{ $message }}
</div>

@enderror


</div>




<button class="btn btn-primary">

{{ isset($employeeDocument)
? 'Update Document'
: 'Upload Document'
}}

</button>



<a href="{{ route('employee-documents.index') }}"
class="btn btn-secondary">

Cancel

</a>



</form>