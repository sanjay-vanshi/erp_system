@extends('layouts.erp')

@section('content')
@include('partials.alert')
{{-- search box here... --}}
<form method="GET" action="{{ route('departments.index') }}" class="mb-3">

    <div class="row">

        <div class="col-md-4">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search by name or code..."
                   value="{{ request('search') }}">

        </div>

    

            <div class="d-flex gap-2 col-md-4">
    <button class="btn btn-primary">
        Search
    </button>

    <a href="{{ route('departments.index') }}"
       class="btn btn-secondary">
        Reset
    </a>
</div>

        

    </div>

</form>
<div class="card shadow-sm">

     <div class="card-header bg-white d-flex justify-content-between align-items-center">

          <h4 class="mb-0">Department List</h4>

      @if(Auth::user()->hasPermission('create departments'))

    <a href="{{ route('departments.create') }}"
       class="btn btn-primary">

        Add Department

    </a>

@endif

    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

@forelse($departments as $department)

<tr>

    <td>{{ $department->id }}</td>

    <td>{{ $department->name }}</td>

    <td>{{ $department->code }}</td>

    <td>{{ $department->description }}</td>

    <td>
        @if($department->status)
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-danger">Inactive</span>
        @endif
    </td>

<td class="text-center">

    

        @if(Auth::user()->hasPermission('edit departments'))

    <a href="{{ route('departments.edit', $department->id) }}"
       class="btn btn-warning btn-sm">

        Edit

    </a>

@endif

        @if(Auth::user()->hasPermission('delete departments'))

<form action="{{ route('departments.destroy', $department->id) }}"
      method="POST">

    @csrf
    @method('DELETE')

    <button class="btn btn-danger btn-sm"
            onclick="return confirm('Are you sure you want to delete this department?')">

        Delete

    </button>

</form>

@endif

    </div>

</td>

</tr>

@empty

<tr>

    <td colspan="6" class="text-center">
        No Departments Found
    </td>

</tr>

@endforelse

</tbody>

        </table>
        {{-- pagination --}}
        <div class="mt-3">
    {{ $departments->links() }}
</div>

    </div>

</div>

@endsection