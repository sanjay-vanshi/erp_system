@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="card shadow-sm">

    {{-- Card Header --}}
    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            Employee List
        </h4>
    @if(Auth::user()->hasPermission('create employees'))
        <a href="{{ route('employees.create') }}"
           class="btn btn-primary btn-sm">
            Add Employee
        </a>
   @endif
    </div>

    <div class="card-body">

        {{-- Search & Filter --}}
        <form method="GET"
              action="{{ route('employees.index') }}"
              class="mb-4">

            <div class="row g-2">

                {{-- Search --}}
                <div class="col-md-3">

                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search by code, name or email..."
                           value="{{ request('search') }}">

                </div>

                {{-- Department --}}
                <div class="col-md-3">

                    <select name="department_id"
                            class="form-select">

                        <option value="">
                            All Departments
                        </option>

                        @foreach($departments as $department)

                            <option value="{{ $department->id }}"
                                {{ request('department_id') == $department->id ? 'selected' : '' }}>

                                {{ $department->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Designation --}}
                <div class="col-md-3">

                    <select name="designation_id"
                            class="form-select">

                        <option value="">
                            All Designations
                        </option>

                        @foreach($designations as $designation)

                            <option value="{{ $designation->id }}"
                                {{ request('designation_id') == $designation->id ? 'selected' : '' }}>

                                {{ $designation->title }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Status --}}
                <div class="col-md-2">

                    <select name="status"
                            class="form-select">

                        <option value="">
                            All Status
                        </option>

                        <option value="active"
                            {{ request('status') == 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ request('status') == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>

                {{-- Filter Button --}}
                <div class="col-md-1 d-grid">

                    <button type="submit"
                            class="btn btn-primary">

                        Filter

                    </button>

                </div>

            </div>

            <div class="mt-2">

                <a href="{{ route('employees.index') }}"
                   class="btn btn-secondary btn-sm">

                    Reset

                </a>

            </div>

        </form>

        {{-- Employee Table --}}
        <table class="table table-bordered table-hover align-middle">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Salary</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($employees as $employee)

                    <tr>

                        <td>{{ $employee->id }}</td>

                        <td>{{ $employee->employee_code }}</td>

                        <td>
                            {{ $employee->first_name }}
                            {{ $employee->last_name }}
                        </td>

                        <td>{{ $employee->email }}</td>

                        <td>{{ $employee->department->name ?? '-' }}</td>

                        <td>{{ $employee->designation->title ?? '-' }}</td>

                        <td>₹{{ number_format($employee->salary, 2) }}</td>

                        <td>

                            @if($employee->status == 'active')

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            <div class="d-flex justify-content-center gap-2">
                                      @if(Auth::user()->hasPermission('edit employees'))

                                <a href="{{ route('employees.edit', $employee->id) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>
                                @endif

                                    @if(Auth::user()->hasPermission('delete employees'))

                                <form action="{{ route('employees.destroy', $employee->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this employee?')">

                                        Delete

                                    </button>

                                </form>
                              @endif
                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9" class="text-center">

                            No Employees Found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        {{-- Pagination --}}
        <div class="mt-3">

            {{ $employees->links() }}

        </div>

    </div>

</div>

@endsection