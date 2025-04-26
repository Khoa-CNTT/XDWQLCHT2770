<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangKyRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'ho_ten'      =>   'required',
            'email'          =>   'required|email|unique:khach_hangs,email',
            'so_dien_thoai'  =>   'required|digits:10',
            'password'       =>   'required|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*?&]).{8,}$/',
            'mat_khau_confirmation'    =>   'required|same:password',
            'ngay_sinh'      =>   'required|date|before:-10 years',
            'gioi_tinh'      =>   'required|in:0,1,2',
        ];
    }
    public function messages()
    {
        return [
            'ho_ten.required'              =>  'Họ tên không được để trống',
            'email.required'               =>  'Email không không được để trống',
            'email.unique'                 =>  'Email đã tồn tại',
            'email.email'                  =>  'Email không đúng định dạng',
            'so_dien_thoai.required'       =>  'Số điện thoại không được để trống',
            'so_dien_thoai.digits'         =>  'Số điện thoại phải đủ 10 số',
            'password.required'            =>  'Mật khẩu không đươc để trống',
            'password.min'                 =>  'Mật khẩu tối thiểu là 5 ký tự',
            'password.regex'               =>  'Mật khẩu phải chứa ít nhất một chữ in hoa, một số, một ký tự đặc biệt và ít nhất 8 ký tự ',
            'mat_khau_confirmation.required'         =>  'Nhập lại khẩu không đươc để trống',
            'mat_khau_confirmation.same'             =>  'Mật khẩu không trùng khớp',
            'ngay_sinh.required'           =>  'Ngày sinh không được để trống',
            'ngay_sinh.before'             =>  'Trên 16 tuổi mới có thể đăng ký tài khoản',
            'ngay_sinh.date'               =>  'Ngày sinh không đúng định dạng',
        ];
    }
}
