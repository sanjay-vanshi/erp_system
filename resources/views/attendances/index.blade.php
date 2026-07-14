@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="card shadow-sm">

    {{-- Card Header --}}
    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">Attendance List</h4>
  @if(Auth::user()->hasPermission('create attendances'))
        <a href="{{ route('attendances.create') }}"
           class="btn btn-primary btn-sm">
            Mark Attendance
        </a>
@endif
    </div>

    {{-- Filter Section --}}
    <div class="card-body border-bottom">

        <form method="GET" action="{{ route('attendances.index') }}">

            <div class="row g-2">

                {{-- Search --}}
                <div class="col-md-3">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search Employee..."
                        value="{{ request('search') }}">
                </div>

                {{-- Employee --}}
                <div class="col-md-3">

                    <select name="employee_id" class="form-select">

                        <option value="">All Employees</option>

                        @foreach($employees as $employee)

                            <option value="{{ $employee->id }}"
                                {{ request('employee_id') == $employee->id ? 'selected' : '' }}>

                                {{ $employee->employee_code }}
                                -
                                {{ $employee->first_name }}
                                {{ $employee->last_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Attendance Date --}}
                <div class="col-md-2">

                    <input
                        type="date"
                        name="attendance_date"
                        class="form-control"
                        value="{{ request('attendance_date') }}">

                </div>

                {{-- Status --}}
                <div class="col-md-2">

                    <select name="status" class="form-select">

                        <option value="">All Status</option>

                        <option value="present"
                            {{ request('status') == 'present' ? 'selected' : '' }}>
                            Present
                        </option>

                        <option value="absent"
                            {{ request('status') == 'absent' ? 'selected' : '' }}>
                            Absent
                        </option>

                        <option value="leave"
                            {{ request('status') == 'leave' ? 'selected' : '' }}>
                            Leave
                        </option>

                        <option value="half_day"
                            {{ request('status') == 'half_day' ? 'selected' : '' }}>
                            Half Day
                        </option>

                    </select>

                </div>

                {{-- Buttons --}}
                <div class="col-md-2 d-flex gap-2">

                    <button class="btn btn-primary w-100">
                        Filter
                    </button>

                    <a href="{{ route('attendances.index') }}"
                       class="btn btn-secondary w-100">
                        Reset
                    </a>

                </div>

            </div>

        </form>

    </div>

    {{-- Table --}}
    <div class="card-body">

        <table class="table table-bordered table-hover align-middle">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Employee Code</th>
                    <th>Employee Name</th>
                    <th>Date</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th class="text-center">Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($attendances as $attendance)

                    <tr>

                        <td>{{ $attendance->id }}</td>

                        <td>{{ $attendance->employee->employee_code }}</td>

                        <td>
                            {{ $attendance->employee->first_name }}
                            {{ $attendance->employee->last_name }}
                        </td>

                        <td>{{ $attendance->attendance_date }}</td>

                        <td>{{ $attendance->check_in ?? '-' }}</td>

                        <td>{{ $attendance->check_out ?? '-' }}</td>

                        <td>

                            @if($attendance->status == 'present')

                                <span class="badge bg-success">
                                    Present
                                </span>

                            @elseif($attendance->status == 'absent')

                                <span class="badge bg-danger">
                                    Absent
                                </span>

                            @elseif($attendance->status == 'leave')

                                <span class="badge bg-warning text-dark">
                                    Leave
                                </span>

                            @else

                                <span class="badge bg-info">
                                    Half Day
                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $attendance->remarks ?? '-' }}

                        </td>

                        <td class="text-center">

                            
                                 @if(Auth::user()->hasPermission('edit attendances'))
                                <a href="{{ route('attendances.edit', $attendance->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                 @endif
                                @if(Auth::user()->hasPermission('delete attendances'))

                                <form
                                    action="{{ route('attendances.destroy', $attendance->id) }}"
                                    method="POST" class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this attendance?')">

                                        Delete

                                    </button>

                                </form>
                          @endif
                            

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9" class="text-center">

                            No Attendance Records Found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $attendances->links() }}

        </div>

    </div>

</div>

@endsection