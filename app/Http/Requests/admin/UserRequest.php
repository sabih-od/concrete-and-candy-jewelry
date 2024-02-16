<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',

        ];

        if ($this->isMethod('put')) {
            // When updating a user (HTTP PATCH method), exclude the current user's email from the uniqueness check.
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id),
            ];
        } else {
            // Only require a password when creating a new user (not when updating).
            $rules['password'] = 'required|min:8';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'name.required' => 'Name is required!',
            'password.required' => 'Password is required!'
        ];
    }
}
