<?php

namespace App\Http\Requests;

use App\Enums\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            // 'status' => 'required|in:' . implode(',', OrderStatus::getAllStatuses()),
            // 'total_amount' => 'required|numeric',
            // 'shipping_fee' => 'nullable|numeric',
            // 'discount_amount' => 'nullable|numeric',
            // 'final_amount' => 'required|numeric',
            // 'payment_method' => 'required|in:' . implode(',', OrderStatus::getAllStatuses()),
            // 'payment_date' => 'nullable|date',
            // 'voucher_code' => 'nullable|string|max:255',
            // 'transaction_id' => 'nullable|integer',
            // 'ref_id' => 'nullable|integer',
            'note' => 'nullable|string',
        ];
    }

    public function attributes(){
        return [
            'status' => 'Trạng thái',
            'total_amount' => 'Tổng tiền',
            'shipping_fee' => 'Phí vận chuyển',
            'discount_amount' => 'Số tiền giảm giá',
            'final_amount' => 'Số tiền cần thanh toán',
            'payment_method' => 'Phương thức thanh toán',
            'payment_date' => 'Ngày thanh toán',
            'voucher_code' => 'Mã giảm giá',
            'transaction_id' => 'Mã giao dịch',
            'ref_id' => 'Mã giao dịch hoàn',
            'note' => 'Ghi chú',
        ];
    }

    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'numeric' => ':attribute phải là số',
            'in' => ':attribute không hợp lệ',
            'date' => ':attribute không hợp lệ',
            'max' => ':attribute không được vượt quá :max ký tự',
        ];
    }
}
