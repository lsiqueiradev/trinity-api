<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;

class StoreUpdateUser extends FormRequest
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
    public function rules(Request $request)
    {
        $id = $this->segment(3);

        $rules = [
            'name' => [
                'min:5',
                'max:255'
            ],
            'email' => [
                'min:5',
                'max:255',
                Rule::unique('users')->ignore($id)
            ],
            'phone' => [
                'min:14',
                'max:15'
            ],
            // 'password' => [
            //     'required',
            //     'confirmed',
            //     Password::min(8)
            //         ->mixedCase()
            //         ->letters()
            //         ->numbers()
            //         ->uncompromised(),
            // ],
            // 'password_confirmation' => ['required'],
        ];

        // if($this->method() == 'PUT'){
        //     if($request->input('password')){
        //         $rules['password'] = [
        //             'confirmed',
        //             Password::min(8)
        //                 ->mixedCase()
        //                 ->numbers()
        //                 ->uncompromised(),
        //         ];
        //         $rules['password_confirmation'] = ['required'];
        //     } else {
        //         $rules['password'] = ['nullable'];
        //         $rules['password_confirmation'] = ['nullable'];
        //     }
        // }

        return $rules ;
    }
}
