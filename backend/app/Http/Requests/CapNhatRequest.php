<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapNhatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|unique:customers,so_dien_thoai,',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|in:0,1,2',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}