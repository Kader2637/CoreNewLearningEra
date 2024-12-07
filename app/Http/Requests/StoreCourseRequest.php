<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:document,link,text_course',
            'document' => 'nullable|file|mimes:pdf|max:2048',
            'link' => 'nullable|url',
            'text_course' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama materi harus diisi.',
            'description.required' => 'Deskripsi materi harus diisi.',
            'type.required' => 'Tipe materi harus dipilih.',
            'document.mimes' => 'Dokumen harus berupa file PDF, DOC, atau DOCX.',
            'document.max' => 'Dokumen tidak boleh lebih dari 2MB.',
            'link.url' => 'URL yang dimasukkan tidak valid.',
        ];
    }
}
