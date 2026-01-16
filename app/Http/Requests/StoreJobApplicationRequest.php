<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplicationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:20480'], // 20MB max
            'years_of_experience' => ['required', 'integer', 'min:0', 'max:50'],
            'specialization' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'phone.required' => 'رقم الهاتف مطلوب',
            'cv.required' => 'السيرة الذاتية مطلوبة',
            'cv.mimes' => 'السيرة الذاتية يجب أن تكون بصيغة PDF أو DOC أو DOCX',
            'cv.max' => 'حجم السيرة الذاتية يجب ألا يتجاوز 20 ميجابايت',
            'years_of_experience.required' => 'عدد سنوات الخبرة مطلوب',
            'years_of_experience.integer' => 'عدد سنوات الخبرة يجب أن يكون رقماً',
            'years_of_experience.min' => 'عدد سنوات الخبرة يجب أن يكون صفر على الأقل',
            'specialization.required' => 'التخصص مطلوب',
        ];
    }
}
