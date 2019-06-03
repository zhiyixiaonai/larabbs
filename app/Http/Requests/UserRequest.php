<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * 确定用户是否有权发出此请求
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 获取适用于请求的验证规则
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,'.Auth::id(),
            'email'        => 'required|email',
            'introduction' => 'max:80',
        ];
    }

    /**
     * 自定义表单的提示信息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique'   => '用户名已被占用，请重新填写',
            'name.regex'    => '用户名只支持英文、数字、横杠和下划线。',
            'name.between'  => '用户名必须介于 3 - 25 个字符之间。',
            'name.required' => '用户名不能为空。',
        ];
    }
}
