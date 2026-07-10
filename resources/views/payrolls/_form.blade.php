@if(!empty($payroll) && $payroll->exists)

<form action="{{ route('payrolls.update', $payroll) }}" method="POST">
    @method('PUT')

@else

<form action="{{ route('payrolls.store') }}" method="POST">

@endif

@csrf


<div class="row">

    {{-- Employee --}}
    <div class="col-md-6 mb-3">

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
                    {{ old('employee_id', $payroll->employee_id ?? '') == $employee->id ? 'selected' : '' }}>

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



    {{-- Payroll Month --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Payroll Month
        </label>

        <input
            type="month"
            name="payroll_month"
            class="form-control @error('payroll_month') is-invalid @enderror"
            value="{{ old('payroll_month', isset($payroll->payroll_month) ? \Carbon\Carbon::parse($payroll->payroll_month)->format('Y-m') : '') }}">

        @error('payroll_month')

            <div class="text-danger mt-1">
                {{ $message }}
            </div>

        @enderror

    </div>



    {{-- Basic Salary --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Basic Salary
        </label>

        <input
            type="number"
            step="0.01"
            name="basic_salary"
            class="form-control @error('basic_salary') is-invalid @enderror"
            value="{{ old('basic_salary', $payroll->basic_salary ?? '') }}">

        @error('basic_salary')

            <div class="text-danger mt-1">
                {{ $message }}
            </div>

        @enderror

    </div>



    {{-- Allowance --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Allowance
        </label>

        <input
            type="number"
            step="0.01"
            name="allowance"
            class="form-control @error('allowance') is-invalid @enderror"
            value="{{ old('allowance', $payroll->allowance ?? '') }}">

        @error('allowance')

            <div class="text-danger mt-1">
                {{ $message }}
            </div>

        @enderror

    </div>



    {{-- Bonus --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Bonus
        </label>

        <input
            type="number"
            step="0.01"
            name="bonus"
            class="form-control @error('bonus') is-invalid @enderror"
            value="{{ old('bonus', $payroll->bonus ?? '') }}">

        @error('bonus')

            <div class="text-danger mt-1">
                {{ $message }}
            </div>

        @enderror

    </div>
        {{-- Overtime --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Overtime
        </label>

        <input
            type="number"
            step="0.01"
            name="overtime"
            class="form-control @error('overtime') is-invalid @enderror"
            value="{{ old('overtime', $payroll->overtime ?? '') }}">

        @error('overtime')

            <div class="text-danger mt-1">
                {{ $message }}
            </div>

        @enderror

    </div>



    {{-- Deduction --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Deduction
        </label>

        <input
            type="number"
            step="0.01"
            name="deduction"
            class="form-control @error('deduction') is-invalid @enderror"
            value="{{ old('deduction', $payroll->deduction ?? '') }}">

        @error('deduction')

            <div class="text-danger mt-1">
                {{ $message }}
            </div>

        @enderror

    </div>



    {{-- Leave Deduction --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Leave Deduction
        </label>

        <input
            type="number"
            step="0.01"
            name="leave_deduction"
            class="form-control @error('leave_deduction') is-invalid @enderror"
            value="{{ old('leave_deduction', $payroll->leave_deduction ?? '') }}">

        @error('leave_deduction')

            <div class="text-danger mt-1">
                {{ $message }}
            </div>

        @enderror

    </div>



    {{-- Tax --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Tax
        </label>

        <input
            type="number"
            step="0.01"
            name="tax"
            class="form-control @error('tax') is-invalid @enderror"
            value="{{ old('tax', $payroll->tax ?? '') }}">

        @error('tax')

            <div class="text-danger mt-1">
                {{ $message }}
            </div>

        @enderror

    </div>



    {{-- Payment Status --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Payment Status
        </label>

        <select
            name="payment_status"
            class="form-select @error('payment_status') is-invalid @enderror">

            <option value="Pending"
                {{ old('payment_status', $payroll->payment_status ?? '') == 'Pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="Paid"
                {{ old('payment_status', $payroll->payment_status ?? '') == 'Paid' ? 'selected' : '' }}>
                Paid
            </option>

        </select>

        @error('payment_status')

            <div class="text-danger mt-1">
                {{ $message }}
            </div>

        @enderror

    </div>



    {{-- Payment Date --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Payment Date
        </label>

        <input
            type="date"
            name="payment_date"
            class="form-control @error('payment_date') is-invalid @enderror"
            value="{{ old('payment_date', $payroll->payment_date ?? '') }}">

        @error('payment_date')

            <div class="text-danger mt-1">
                {{ $message }}
            </div>

        @enderror

    </div>
        {{-- Remarks --}}
    <div class="col-md-12 mb-3">

        <label class="form-label">
            Remarks
        </label>

        <textarea
            name="remarks"
            rows="3"
            class="form-control @error('remarks') is-invalid @enderror"
            placeholder="Enter remarks">{{ old('remarks', $payroll->remarks ?? '') }}</textarea>

        @error('remarks')

            <div class="text-danger mt-1">
                {{ $message }}
            </div>

        @enderror

    </div>

</div>



<button type="submit" class="btn btn-primary">

    {{ isset($payroll) ? 'Update Payroll' : 'Create Payroll' }}

</button>


<a href="{{ route('payrolls.index') }}"
   class="btn btn-secondary">

    Cancel

</a>


</form>