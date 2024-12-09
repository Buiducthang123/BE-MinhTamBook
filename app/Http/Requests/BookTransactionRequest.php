<?php

namespace App\Http\Requests;

use App\Enums\BookTransactionStatus;
use App\Enums\BookTransactionType;
use Illuminate\Foundation\Http\FormRequest;

class BookTransactionRequest extends FormRequest
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
        $rules = [
            'book_id' => 'required|integer|exists:books,id',
            'user_id' => 'nullable|integer|exists:users,id',
            'note' => 'string|nullable',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'status' => 'required|in:' . implode(',', BookTransactionStatus::getValues()),
            'type' => 'required|in:' . implode(',', BookTransactionType::getValues()),
            'date' => 'required|date',
        ];
        return $rules;
    }

    public function messages(){
        return [
            'book_id.required' => 'ID sách không được để trống',
            'book_id.integer' => 'ID sách phải là số',
            'book_id.exists' => 'ID sách không tồn tại',
            'user_id.integer' => 'ID người dùng phải là số',
            'user_id.exists' => 'ID người dùng không tồn tại',
            'note.string' => 'Ghi chú phải là chuỗi',
            'price.required' => 'Giá không được để trống',
            'price.numeric' => 'Giá phải là số',
            'quantity.required' => 'Số lượng không được để trống',
            'quantity.integer' => 'Số lượng phải là số',
            'status.required' => 'Trạng thái không được để trống',
            'status.in' => 'Trạng thái không hợp lệ',
            'type.required' => 'Loại không được để trống',
            'type.in' => 'Loại không hợp lệ',
            'date.required' => 'Ngày không được để trống',
            'date.date' => 'Ngày phải là ngày',
            'date.date_format' => 'Ngày phải đúng định dạng d-m-Y',
        ];
    }
}
