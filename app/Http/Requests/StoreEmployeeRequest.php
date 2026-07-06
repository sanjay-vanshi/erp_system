<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'employee_code' => 'required|string|max:50|unique:employees,employee_code',
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'email'         => 'required|email|unique:employees,email',
            'phone'         => 'nullable|string|max:20',

            'department_id'  => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',

            'salary'        => 'required|numeric|min:0',
            'joining_date'  => 'required|date',

            'address'       => 'nullable|string',

            'status'        => 'required|in:active,inactive',
        ];
    }
}
