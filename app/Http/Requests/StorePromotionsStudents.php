<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromotionsStudents extends FormRequest
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
        // Old data
        'Grade_id' => 'required|integer|exists:grades,id',
        'Classroom_id' => 'required|integer|exists:classrooms,id',
        'section_id' => 'required|integer|exists:sections,id',
        'academic_year' => 'required|string',

        // New data
        'Grade_id_new' => 'required|integer|exists:grades,id|different:Grade_id',
        'Classroom_id_new' => 'required|integer|exists:classrooms,id|different:Classroom_id',
        'section_id_new' => 'required|integer|exists:sections,id|different:section_id',
        'academic_year_new' => 'required|string|different:academic_year',
    ];
}
public function messages(): array
{
    return [
        'section_id.exists' => 'القسم المختار غير موجود.',
        'section_id_new.exists' => 'القسم الجديد غير موجود.',
        'Classroom_id.exists' => 'الفصل الدراسي القديم غير موجود.',
        'Classroom_id_new.exists' => 'الفصل الدراسي الجديد غير موجود.',
    ];
}

    
}
