<?php

namespace cjango\CPanel\Requests;

class PermissionRequest extends Request
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
                    'name'       => 'required|between:2,32|unique:admin_roles',
                    'guard_name' => 'required',
                ];
                break;
            case 'PUT':
                $id    = $this->route('role')->id;
                $rules = [
                    'name'       => 'required|between:2,32|unique:admin_roles,name,' . $id,
                    'guard_name' => 'required',
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
            'name.required' => '权限标识必须填写',
            'name.between'  => '权限标识长度应在:min-:max位之间',
            'name.unique'   => '权限标识已经存在',
        ];
    }
}
