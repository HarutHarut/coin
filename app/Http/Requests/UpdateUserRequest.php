<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'phone' => ['required', 'numeric', 'digits:11', 'unique:users'],

            'email' => 'required|email|unique:users,id,' . $this->route('user'),
            'phone' => 'required|numeric|digits:11|unique:users,id,' . $this->route('user'),

            'role_id' => ['required', 'numeric'],
            'avatar' => ['file'],
//            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }
}
