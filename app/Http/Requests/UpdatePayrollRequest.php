<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePayrollRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'employee_id' => [
                'required',
                'exists:employees,id',
                Rule::unique('payrolls')
                    ->where(function ($query) {
                        return $query->where('employee_id', $this->employee_id)
                            ->where('payroll_month', $this->payroll_month);
                    })
                    ->ignore($this->route('payroll')),
            ],

            'payroll_month' => 'required|date',

            'basic_salary' => 'required|numeric|min:0',

            'allowance' => 'nullable|numeric|min:0',

            'bonus' => 'nullable|numeric|min:0',

            'overtime' => 'nullable|numeric|min:0',

            'deduction' => 'nullable|numeric|min:0',

            'leave_deduction' => 'nullable|numeric|min:0',

            'tax' => 'nullable|numeric|min:0',

            'payment_status' => 'required|in:Pending,Paid',

            'payment_date' => 'nullable|date|required_if:payment_status,Paid',

            'remarks' => 'nullable|string|max:1000',
        ];
    }
}
