<?php

namespace cjango\CPanel\Requests;

use Auth;
use Hash;

class PasswordRequest extends Request
{

    public function rules()
    {
        switch ($this->method()) {
            case 'PUT':
                $rules = [
                    'oldpass' => ['required', function ($attribute, $value, $fail) {
                        if (!Hash::check($value, Auth::guard('admin')->user()->password)) {
                            return $fail('原始密码不正确');
                        }
                    }],
                    'newpass' => 'required|between:6,32|different:oldpass',
                    'repass'  => 'required|same:newpass',
                ];
                break;
            default:
                $rules = [];
                break;
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'oldpass.required'  => '原始密码必须填写',
            'newpass.required'  => '新的密码必须填写',
            'newpass.between'   => '新密码长度应在:min-:max位之间',
            'newpass.different' => '新密码不能与原密码相同',
            'repass.required'   => '确认密码必须填写',
            'repass.same'       => '两次输入的密码不一致',
        ];
    }
}
