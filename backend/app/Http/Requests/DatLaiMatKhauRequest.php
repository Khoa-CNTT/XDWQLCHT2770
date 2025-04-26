<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatLaiMatKhauRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:customers,email',
            'mat_khau' => 'required|string|min:6|confirmed',
            'hash_reset' => 'required|string',
        ];
    }
}