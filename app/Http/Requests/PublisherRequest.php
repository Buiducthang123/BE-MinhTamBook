<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublisherRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'avatar' => 'nullable|string|max:2048',
        ];

        if($this->isMethod('put') || $this->isMethod('patch')){
            $rules['name'] = 'string|max:255';
        }

        return $rules;
    }

    public function messages():array{
        return [
            'name.required' => 'Tên nhà xuất bản không được để trống',
            'name.string' => 'Tên nhà xuất bản phải là chuỗi',
            'name.max' => 'Tên nhà xuất bản không được vượt quá 255 ký tự',
            'avatar.string' => 'Ảnh đại diện phải là chuỗi',
            'avatar.max' => 'Ảnh đại diện không được vượt quá 255 ký tự',
            'description.string' => 'Mô tả nhà xuất bản phải là chuỗi',
        ];
    }
}
