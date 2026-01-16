<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDesignRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'project_type' => 'required|string',
            'budget_range' => 'nullable|string|max:255',
            'deadline' => 'nullable|string|max:255',
            'details' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ];
    }
}
