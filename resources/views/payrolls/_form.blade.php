<div class="row">

    {{-- Employee --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Employee
        </label>

        <select name="employee_id" class="form-select">

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
            <span class="text-danger">
                {{ $message }}
            </span>
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
            class="form-control"
            value="{{ old(
                'payroll_month',
                isset($payroll->payroll_month)
                ? \Carbon\Carbon::parse($payroll->payroll_month)->format('Y-m')
                : ''
            ) }}"
        >


        @error('payroll_month')
            <span class="text-danger">
                {{ $message }}
            </span>
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
            class="form-control"
            value="{{ old('basic_salary', $payroll->basic_salary ?? '') }}"
        >

        @error('basic_salary')
            <span class="text-danger">
                {{ $message }}
            </span>
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
            class="form-control"
            value="{{ old('allowance', $payroll->allowance ?? '') }}"
        >

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
            class="form-control"
            value="{{ old('bonus', $payroll->bonus ?? '') }}"
        >

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
            class="form-control"
            value="{{ old('overtime', $payroll->overtime ?? '') }}"
        >

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
            class="form-control"
            value="{{ old('deduction', $payroll->deduction ?? '') }}"
        >

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
            class="form-control"
            value="{{ old('leave_deduction', $payroll->leave_deduction ?? '') }}"
        >

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
            class="form-control"
            value="{{ old('tax', $payroll->tax ?? '') }}"
        >

    </div>



    {{-- Payment Status --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Payment Status
        </label>

        <select name="payment_status" class="form-select">

            <option value="Pending"
            {{ old('payment_status', $payroll->payment_status ?? '') == 'Pending' ? 'selected' : '' }}>
                Pending
            </option>


            <option value="Paid"
            {{ old('payment_status', $payroll->payment_status ?? '') == 'Paid' ? 'selected' : '' }}>
                Paid
            </option>

        </select>

    </div>



    {{-- Payment Date --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Payment Date
        </label>

        <input 
            type="date"
            name="payment_date"
            class="form-control"
            value="{{ old('payment_date', $payroll->payment_date ?? '') }}"
        >

    </div>



    {{-- Remarks --}}
    <div class="col-md-12 mb-3">

        <label class="form-label">
            Remarks
        </label>


        <textarea 
            name="remarks"
            class="form-control"
            rows="3">{{ old('remarks', $payroll->remarks ?? '') }}</textarea>

    </div>


</div>