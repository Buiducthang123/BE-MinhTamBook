<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShoppingCartRequest extends FormRequest
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
            // 'user_id' => 'required|integer|exists:users,id',
            'book_id' => 'required|integer|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(){
        return [
            'user_id.required' => 'User ID là bắt buộc.',
            'user_id.integer' => 'User ID phải là số.',
            'user_id.exists' => 'User ID không tồn tại.',
            'book_id.required' => 'Book ID là bắt buộc.',
            'book_id.integer' => 'Book ID phải là số.',
            'book_id.exists' => 'Book ID không tồn tại.',
            'quantity.required' => 'Số lượng là bắt buộc.',
            'quantity.integer' => 'Số lượng phải là số.',
            'quantity.min' => 'Số lượng phải lớn hơn 0.',
        ];
    }
}
