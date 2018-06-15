<?php

namespace cjango\CPanel\Requests;

class AdminRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                $rules = [
                    'username' => ['required', 'between:4,32', 'unique:admins'],
                    'password' => 'required|between:6,32',
                    'nickname' => 'nullable|between:2,16',
                ];
                break;
            case 'PUT':
                $rules = [
                    'password' => 'nullable|between:6,32',
                    'nickname' => 'nullable|between:2,16',
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
            'username.required' => '用户名称必须填写',
            'username.between'  => '用户名称长度应在:min-:max位之间',
            'username.unique'   => '用户名称已经存在',
            'password.required' => '登录密码必须填写',
            'password.between'  => '登录密码长度应在:min-:max位之间',
            'nickname.between'  => '用户昵称长度应在:min-:max位之间',
        ];
    }
}
