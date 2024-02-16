<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'stock_quantity' => 'required',
            'photo' => 'required',
            'photo.*' => 'image|max:2048', // Max 2MB file size for each image
            'gallery' => 'array',
            'gallery.*' => 'image|max:2048', // Max 2MB file size for each gallery image
        ];

        // Add conditional rules
        if ($this->input('product_variation_check')) {
            $rules['variation_sizes.*'] = 'required';
            $rules['variation_prices.*'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'price.required' => 'Price is required!',
            'stock_quantity.required' => 'Stock Quantity is required!',
            'category_id.required' => 'Category is required!',
            'photo.required' => 'At least one image is required!',
            'photo.*.image' => 'Each image must be a valid image file!',
            'photo.*.max' => 'Each image should not exceed 2MB in size!',
            'gallery.array' => 'Gallery should be in an array format!',
            'gallery.*.image' => 'Each item in the gallery must be a valid image file!',
            'gallery.*.max' => 'Each gallery image should not exceed 2MB in size!',
            'variation_sizes.*.required' => 'Size is required for each variation!',
            'variation_prices.*.required' => 'Price is required for each variation!',
        ];
    }
}

