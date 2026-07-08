<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveRequest extends FormRequest
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

            'employee_id' => [
                'required',
                'exists:employees,id',
            ],

            'leave_type' => [
                'required',
                'in:sick,casual,paid,emergency',
            ],

            'from_date' => [
                'required',
                'date',
            ],

            'to_date' => [
                'required',
                'date',
                'after_or_equal:from_date',
            ],

            'total_days' => [
                'required',
                'integer',
                'min:1',
            ],

            'reason' => [
                'nullable',
                'string',
                'max:500',
            ],

            'status' => [
                'required',
                'in:pending,approved,rejected',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:500',
            ],

        ];
    }
}
