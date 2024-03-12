<?php

namespace App\Http\Requests\API\HolidayPlan;

use Illuminate\Foundation\Http\FormRequest;

class CreateHolidayPlanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'participants' => 'nullable|string',
            'date' => 'required|date'
        ];
    }
}
