<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorsBookRequest extends FormRequest
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
            'author_id' => 'required|exists:authors,id',
            'book_id' => 'required|exists:books,id',
        ];
    }

    public function messages(): array
    {
        return [
            'author_id.required' => 'ID Tác giả là bắt buộc',
            'author_id.exists' => 'ID Tác giả không tồn tại',
            'book_id.required' => 'ID Sách là bắt buộc',
            'book_id.exists' => 'ID Sách không tồn tại',
        ];
    }
}
