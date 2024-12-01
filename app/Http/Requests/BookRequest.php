<?php

namespace App\Http\Requests;

use App\Enums\Book\Format;
use App\Enums\Book\Language;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
            'book_id'=>'exists:books,id',
            'ISBN'=>'required|max:20',
            'language' => 'required|in:' . implode(',', (array) Language::getValues()),
            'format' => 'required|in:' . implode(',', (array) Format::getValues()),
            'published_date'=>'required|date',
            'short_description'=>'required',
            'entry_price'=>'required|numeric',
            'entry_quantity'=>'required|integer',
            'stock_quantity'=>'required|integer',
            'sold_quantity'=>'required|integer',
            'cover_image'=>'required|url',
            'thumbnails'=>'required|array',
            'thumbnails.*'=>'url',
            'pages'=>'required|integer',
            'weight'=>'required|numeric',
            'dimension_length'=>'required|numeric',
            'dimension_width'=>'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'numeric' => ':attribute phải là số.',
            'integer' => ':attribute phải là số nguyên.',
            'date' => ':attribute không đúng định dạng ngày.',
            'url' => ':attribute không đúng định dạng URL.',
            'max' => ':attribute không được quá :max ký tự.',
            'in' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'Danh mục',
            'publisher_id' => 'Nhà xuất bản',
            'book_id' => 'Sách',
            'ISBN' => 'Mã ISBN',
            'language' => 'Ngôn ngữ',
            'format' => 'Định dạng',
            'published_date' => 'Ngày xuất bản',
            'thumbnails' => 'Ảnh minh họa',
            'pages' => 'Số trang',
            'weight' => 'Trọng lượng',
            'dimension_length' => 'Chiều dài',
            'dimension_width' => 'Chiều rộng',
        ];
    }
}
