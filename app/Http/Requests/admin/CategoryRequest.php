<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|string',
            'category_img' => 'required',
            'category_img.*' => 'image|max:2048', // Max 2MB file size for each image
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'category_img.required' => 'Category Image is required!',
            'category_img.*.image' => 'Each image must be a valid image file!',
            'category_img.*.max' => 'Each image should not exceed 2MB in size!',
        ];
    }
}
