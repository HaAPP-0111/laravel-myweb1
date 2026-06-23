<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        $passwordRule = $userId ? ['nullable', 'min:6', 'max:32'] : ['required', 'min:6', 'max:32'];

        return [
            'fullname' => ['required', 'min:3', 'max:100'],
            'username' => ['required', 'min:3', 'max:30', 'unique:users,username,' . $userId],
            'email'    => ['required', 'email', 'max:50', 'unique:users,email,' . $userId],
            'password' => $passwordRule,
            'phone'    => ['nullable', 'max:20'],
            'gender'   => ['required', 'in:0,1,2'],
            'role'     => ['required', 'in:1,2'],
            'status'   => ['required', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'Họ và tên không được bỏ trống.',
            'fullname.min'      => 'Họ và tên phải có ít nhất 3 ký tự.',
            'fullname.max'      => 'Họ và tên không được vượt quá 100 ký tự.',
            'username.required' => 'Tên đăng nhập không được bỏ trống.',
            'username.min'      => 'Tên đăng nhập phải có ít nhất 3 ký tự.',
            'username.max'      => 'Tên đăng nhập không được vượt quá 30 ký tự.',
            'username.unique'   => 'Tên đăng nhập này đã được sử dụng.',
            'email.required'    => 'Email không được bỏ trống.',
            'email.email'       => 'Email không đúng định dạng.',
            'email.max'         => 'Email không được vượt quá 50 ký tự.',
            'email.unique'      => 'Email này đã được đăng ký.',
            'password.required' => 'Mật khẩu không được bỏ trống.',
            'password.min'      => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.max'      => 'Mật khẩu không được vượt quá 32 ký tự.',
            'gender.required'   => 'Vui lòng chọn giới tính.',
            'gender.in'         => 'Giới tính không hợp lệ.',
            'role.required'     => 'Vui lòng chọn vai trò.',
            'role.in'           => 'Vai trò không hợp lệ.',
            'status.required'   => 'Vui lòng chọn trạng thái.',
            'status.in'         => 'Trạng thái không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'fullname' => 'Họ và tên',
            'username' => 'Tên đăng nhập',
            'email'    => 'Email',
            'password' => 'Mật khẩu',
            'phone'    => 'Số điện thoại',
            'gender'   => 'Giới tính',
            'role'     => 'Vai trò',
            'status'   => 'Trạng thái',
        ];
    }
}
