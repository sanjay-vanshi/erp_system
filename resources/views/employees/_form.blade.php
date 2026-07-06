@if(isset($employee))
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
    @method('PUT')
@else
    <form action="{{ route('employees.store') }}" method="POST">
@endif

    @csrf

    <div class="row">

        {{-- Employee Code --}}
        <div class="col-md-4 mb-3">
            <label class="form-label">Employee Code</label>

            <input type="text"
                   name="employee_code"
                   class="form-control @error('employee_code') is-invalid @enderror"
                   value="{{ old('employee_code', $employee->employee_code ?? '') }}"
                   placeholder="Enter Employee Code">

            @error('employee_code')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- First Name --}}
        <div class="col-md-4 mb-3">
            <label class="form-label">First Name</label>

            <input type="text"
                   name="first_name"
                   class="form-control @error('first_name') is-invalid @enderror"
                   value="{{ old('first_name', $employee->first_name ?? '') }}"
                   placeholder="Enter First Name">

            @error('first_name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Last Name --}}
        <div class="col-md-4 mb-3">
            <label class="form-label">Last Name</label>

            <input type="text"
                   name="last_name"
                   class="form-control @error('last_name') is-invalid @enderror"
                   value="{{ old('last_name', $employee->last_name ?? '') }}"
                   placeholder="Enter Last Name">

            @error('last_name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>

            <input type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $employee->email ?? '') }}"
                   placeholder="Enter Email">

            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Phone --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Phone</label>

            <input type="text"
                   name="phone"
                   class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone', $employee->phone ?? '') }}"
                   placeholder="Enter Phone Number">

            @error('phone')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Department --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Department</label>

            <select name="department_id"
                    class="form-select @error('department_id') is-invalid @enderror">

                <option value="">Select Department</option>

                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}"
                        {{ old('department_id', $employee->department_id ?? '') == $dept->id ? 'selected' : '' }}>
                        {{ $dept->name }}
                    </option>
                @endforeach

            </select>

            @error('department_id')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Designation --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Designation</label>

            <select name="designation_id"
                    class="form-select @error('designation_id') is-invalid @enderror">

                <option value="">Select Designation</option>

                @foreach($designations as $des)
                    <option value="{{ $des->id }}"
                        {{ old('designation_id', $employee->designation_id ?? '') == $des->id ? 'selected' : '' }}>
                        {{ $des->title }}
                    </option>
                @endforeach

            </select>

            @error('designation_id')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Salary --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Salary</label>

            <input type="number"
                   name="salary"
                   class="form-control @error('salary') is-invalid @enderror"
                   value="{{ old('salary', $employee->salary ?? 0) }}"
                   placeholder="Enter Salary">

            @error('salary')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Joining Date --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Joining Date</label>

            <input type="date"
                   name="joining_date"
                   class="form-control @error('joining_date') is-invalid @enderror"
                   value="{{ old('joining_date', $employee->joining_date ?? '') }}">

            @error('joining_date')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Address --}}
        <div class="col-md-12 mb-3">
            <label class="form-label">Address</label>

            <textarea name="address"
                      class="form-control @error('address') is-invalid @enderror"
                      rows="3"
                      placeholder="Enter Address">{{ old('address', $employee->address ?? '') }}</textarea>

            @error('address')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Status --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Status</label>

            <select name="status"
                    class="form-select @error('status') is-invalid @enderror">

                <option value="active"
                    {{ old('status', $employee->status ?? 'active') == 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="inactive"
                    {{ old('status', $employee->status ?? 'active') == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

            @error('status')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="mt-3">

        <button type="submit" class="btn btn-primary">
            {{ isset($employee) ? 'Update Employee' : 'Save Employee' }}
        </button>

        <a href="{{ route('employees.index') }}" class="btn btn-secondary">
            Cancel
        </a>

    </div>

</form>