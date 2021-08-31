<?php

namespace App\Http\Requests\User;

use App\Rules\IsAccountTypeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],

            'mobile_no' => [
                'required',
                'digits:11',
                'unique:users,mobile_no',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(6),
            ],

            'account_type' => [
                'required',
                new IsAccountTypeRule(['personal', 'company']),
            ],

            'nid_no' => ['required',
                'digits:10',
                'unique:users,nid_no',
            ],

            'nid_front_img' => [
                'required',
            ],

            'nid_back_img'  => [
                'required',
            ],

            'vat_no' => [
                Rule::requiredIf($this->input('account_type') == 'company'),
                'nullable',
                'digits:10',
            ],

            'vat_img' => [
                Rule::requiredIf($this->input('account_type') == 'company'),
            ],
        ];
    }
}
