@if(isset($attendance))
    <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
        @method('PUT')
@else
    <form action="{{ route('attendances.store') }}" method="POST">
@endif

    @csrf

    {{-- Employee --}}
    <div class="mb-3">

        <label class="form-label">Employee</label>

        <select
            name="employee_id"
            class="form-select @error('employee_id') is-invalid @enderror">

            <option value="">Select Employee</option>

            @foreach($employees as $employee)

                <option
                    value="{{ $employee->id }}"
                    {{ old('employee_id', $attendance->employee_id ?? '') == $employee->id ? 'selected' : '' }}>

                    {{ $employee->employee_code }} -
                    {{ $employee->first_name }} {{ $employee->last_name }}

                </option>

            @endforeach

        </select>

        @error('employee_id')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror

    </div>

    {{-- Attendance Date --}}
    <div class="mb-3">

        <label class="form-label">Attendance Date</label>

        <input
            type="date"
            name="attendance_date"
            class="form-control @error('attendance_date') is-invalid @enderror"
            value="{{ old('attendance_date', $attendance->attendance_date ?? '') }}">

        @error('attendance_date')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror

    </div>

    {{-- Check In --}}
    <div class="mb-3">

        <label class="form-label">Check In</label>

        <input
            type="time"
            name="check_in"
            class="form-control @error('check_in') is-invalid @enderror"
            value="{{ old('check_in', $attendance->check_in ?? '') }}">

        @error('check_in')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror

    </div>

    {{-- Check Out --}}
    <div class="mb-3">

        <label class="form-label">Check Out</label>

        <input
            type="time"
            name="check_out"
            class="form-control @error('check_out') is-invalid @enderror"
            value="{{ old('check_out', $attendance->check_out ?? '') }}">

        @error('check_out')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror

    </div>

    {{-- Status --}}
    <div class="mb-3">

        <label class="form-label">Status</label>

        <select
            name="status"
            class="form-select @error('status') is-invalid @enderror">

            <option value="present"
                {{ old('status', $attendance->status ?? 'present') == 'present' ? 'selected' : '' }}>
                Present
            </option>

            <option value="absent"
                {{ old('status', $attendance->status ?? '') == 'absent' ? 'selected' : '' }}>
                Absent
            </option>

            <option value="leave"
                {{ old('status', $attendance->status ?? '') == 'leave' ? 'selected' : '' }}>
                Leave
            </option>

            <option value="half_day"
                {{ old('status', $attendance->status ?? '') == 'half_day' ? 'selected' : '' }}>
                Half Day
            </option>

        </select>

        @error('status')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror

    </div>

    {{-- Remarks --}}
    <div class="mb-3">

        <label class="form-label">Remarks</label>

        <textarea
            name="remarks"
            rows="4"
            class="form-control @error('remarks') is-invalid @enderror"
            placeholder="Enter Remarks">{{ old('remarks', $attendance->remarks ?? '') }}</textarea>

        @error('remarks')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror

    </div>

    <button type="submit" class="btn btn-primary">

        {{ isset($attendance) ? 'Update Attendance' : 'Save Attendance' }}

    </button>

    <a href="{{ route('attendances.index') }}" class="btn btn-secondary">
        Cancel
    </a>

</form>