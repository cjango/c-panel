<?php

namespace cjango\CPanel\Requests;

class UserRequest extends Request
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
                    'username' => 'required|between:4,32|unique:users',
                    'password' => 'required|between:6,32',
                ];
                break;
            case 'PUT':
                $rules = [
                    'password' => 'nullable|between:6,32',
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
            'username.required' => '用户名必须填写',
            'username.between'  => '用户名长度应在:min-:max位之间',
            'username.unique'   => '用户名已经存在',
            'password.required' => '密码必须填写',
            'password.between'  => '密码长度应在:min-:max位之间',
        ];
    }
}
