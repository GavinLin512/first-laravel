<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserData extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return false;
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        dd(request());
//        request()->isMethod('PUT');
//        dd(request()->isMethod('PUT'));
        // 判斷不同的 method 去 return 不同的 validation
        if (request()->isMethod('POST')) {
            return [
                //
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required'],
                'phone' => ['required'],
                'address' => ['required']
            ];
        } elseif (request()->isMethod('PUT')) {
            return  [
                'name' => ['bail','required', 'string', 'max:255'],
//                'name' => 'bail|required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255'],
//                'email' => 'required|string|email|max:255',
            // 判斷空白鍵，空白鍵為特殊字元，有隱藏字串\n，但不會經過 required 驗證
                // nullable 放最後判斷，順序會影響
                'password' => ['string', 'min:8', 'confirmed','nullable'],
                'role' => ['required'],
                'phone' => ['required'],
                'address' => ['required']
            ];
        } else {
            abort(403, 'this method not validate');
        }

    }

    public function  messages()
    {
        return [
            'name.required' => '請輸入您的姓名',
            'email.email' => '請輸入符合email格式的信箱',
            // 變數.驗證規則
            'password.min' => '請輸入至少8個英數字組合',
            'role.required' => '請選擇您的角色',
            'phone.required' => '請填寫電話',
            'address.required' => '請填寫地址'
        ];
    }

    public function attributes()
    {
        return [
            // 修改驗證變數命名
            'email' => '信箱',
        ];
    }
}
