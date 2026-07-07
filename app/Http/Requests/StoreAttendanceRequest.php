<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
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

            'employee_id' => 'required|exists:employees,id',

            'attendance_date' => 'required|date',

            'check_in' => 'nullable|date_format:H:i',

            'check_out' => 'nullable|date_format:H:i',

            'status' => 'required|in:present,absent,leave,half_day',

            'remarks' => 'nullable|string|max:500',

        ];

    }
}
