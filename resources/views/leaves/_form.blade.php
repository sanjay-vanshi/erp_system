
@if(!empty($leave) && $leave->exists)

<form action="{{ route('leaves.update', $leave) }}" method="POST">
    @method('PUT')

@else

<form action="{{ route('leaves.store') }}" method="POST">

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
                {{ old('employee_id', $leave->employee_id ?? '') == $employee->id ? 'selected' : '' }}>

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



{{-- Leave Type --}}
<div class="mb-3">

    <label class="form-label">
        Leave Type
    </label>


    <select 
        name="leave_type"
        class="form-select @error('leave_type') is-invalid @enderror">


        <option value="">
            Select Leave Type
        </option>


        <option value="sick"
        {{ old('leave_type', $leave->leave_type ?? '') == 'sick' ? 'selected' : '' }}>
            Sick Leave
        </option>


        <option value="casual"
        {{ old('leave_type', $leave->leave_type ?? '') == 'casual' ? 'selected' : '' }}>
            Casual Leave
        </option>


        <option value="paid"
        {{ old('leave_type', $leave->leave_type ?? '') == 'paid' ? 'selected' : '' }}>
            Paid Leave
        </option>


        <option value="emergency"
        {{ old('leave_type', $leave->leave_type ?? '') == 'emergency' ? 'selected' : '' }}>
            Emergency Leave
        </option>


    </select>


    @error('leave_type')

    <div class="text-danger mt-1">
        {{ $message }}
    </div>

    @enderror


</div>




{{-- From Date --}}
<div class="mb-3">

<label class="form-label">
    From Date
</label>


<input 
type="date"
name="from_date"
class="form-control @error('from_date') is-invalid @enderror"
value="{{ old('from_date', $leave->from_date ?? '') }}">


@error('from_date')

<div class="text-danger mt-1">
    {{ $message }}
</div>

@enderror


</div>




{{-- To Date --}}
<div class="mb-3">

<label class="form-label">
    To Date
</label>


<input 
type="date"
name="to_date"
class="form-control @error('to_date') is-invalid @enderror"
value="{{ old('to_date', $leave->to_date ?? '') }}">


@error('to_date')

<div class="text-danger mt-1">
    {{ $message }}
</div>

@enderror


</div>




{{-- Total Days --}}
<div class="mb-3">

<label class="form-label">
    Total Days
</label>


<input 
type="number"
name="total_days"
class="form-control @error('total_days') is-invalid @enderror"
value="{{ old('total_days', $leave->total_days ?? '') }}" readonly>


@error('total_days')

<div class="text-danger mt-1">
    {{ $message }}
</div>

@enderror


</div>




{{-- Reason --}}
<div class="mb-3">

<label class="form-label">
    Reason
</label>


<textarea
name="reason"
rows="4"
class="form-control @error('reason') is-invalid @enderror"
placeholder="Enter reason">{{ old('reason', $leave->reason ?? '') }}</textarea>


@error('reason')

<div class="text-danger mt-1">
    {{ $message }}
</div>

@enderror


</div>




@if(isset($leave))

{{-- Status --}}
<div class="mb-3">

<label class="form-label">
    Status
</label>


<select 
name="status"
class="form-select @error('status') is-invalid @enderror">


<option value="pending"
{{ old('status', $leave->status ?? '') == 'pending' ? 'selected' : '' }}>
Pending
</option>


<option value="approved"
{{ old('status', $leave->status ?? '') == 'approved' ? 'selected' : '' }}>
Approved
</option>


<option value="rejected"
{{ old('status', $leave->status ?? '') == 'rejected' ? 'selected' : '' }}>
Rejected
</option>


</select>


@error('status')

<div class="text-danger mt-1">
{{ $message }}
</div>

@enderror


</div>



{{-- Remarks --}}
<div class="mb-3">

<label class="form-label">
    Remarks
</label>


<textarea
name="remarks"
rows="3"
class="form-control">{{ old('remarks', $leave->remarks ?? '') }}</textarea>


</div>

@endif




<button type="submit" class="btn btn-primary">

{{ isset($leave) ? 'Update Leave' : 'Submit Leave' }}

</button>



<a href="{{ route('leaves.index') }}"
class="btn btn-secondary">

Cancel

</a>


</form>