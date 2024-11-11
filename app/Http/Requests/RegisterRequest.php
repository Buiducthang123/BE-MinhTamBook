<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:255|confirmed',
            'full_name' => 'required|max:255',
        ];

        $isCompanyUser = false;
        if (isset($data['company_name']) || isset($data['company_address']) || isset($data['company_phone_number']) || isset($data['company_tax_code']) || isset($data['contact_person_name']) || isset($data['representative_id_card']) || isset($data['representative_id_card_date']) || isset($data['contact_person_position'])) {
            $isCompanyUser = true;
        }

        if($isCompanyUser){
            $rules =  array_merge($rules, [
                // 'phone_number' => 'required|regex:/^0[0-9]{9}$/',
                'company_name' => 'required|max:255',
                'company_address' => 'required|max:255',
                'company_phone_number' => 'required|regex:/^0[0-9]{9}$/',
                'company_tax_code' => 'required|regex:/^[0-9]{10}$/', // Mã số thuế có 10 chữ số // ví dụ: 1234567890
                'contact_person_name' => 'required|max:255',
                'representative_id_card' => 'required|regex:/^[0-9]{9}$/',
                'representative_id_card_date' => 'required|date',
                'contact_person_position' => 'required|max:255',
            ]);
        }

        return $rules;
    }

    public function messages(): array{
        return [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu không được quá 255 ký tự',
            'password.confirmed' => 'Mật khẩu không khớp',
            'full_name.required' => 'Họ tên không được để trống',
            'full_name.max' => 'Họ tên không được quá 255 ký tự',
            'phone_number.required' => 'Số điện thoại không được để trống',
            'phone_number.regex' => 'Số điện thoại không đúng định dạng',
            'company_name.required' => 'Tên công ty không được để trống',
            'company_name.max' => 'Tên công ty không được quá 255 ký tự',
            'company_address.required' => 'Địa chỉ công ty không được để trống',
            'company_address.max' => 'Địa chỉ công ty không được quá 255 ký tự',
            'company_phone_number.required' => 'Số điện thoại công ty không được để trống',
            'company_phone_number.regex' => 'Số điện thoại công ty không đúng định dạng',
            'company_tax_code.required' => 'Mã số thuế công ty không được để trống',
            'company_tax_code.regex' => 'Mã số thuế công ty không đúng định dạng',
            'contact_person_name.required' => 'Tên người liên hệ không được để trống',
            'contact_person_name.max' => 'Tên người liên hệ không được quá 255 ký tự',
            'representative_id_card.required' => 'Số CMND không được để trống',
            'representative_id_card.regex' => 'Số CMND không đúng định dạng',
        ];
    }
}
