<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'pack_content' => 'required',
            'diameter_id' => 'nullable',
            'base_curve_id' => 'nullable',
            'material_id' => 'nullable',
            'tone_id' => 'nullable',
            'lens_design_id' => 'nullable',
            'water_content' => 'nullable',
            'color_id' => 'nullable',
            'duration_id' => 'nullable',
            'product_intro' => 'required',
            'category_id' => 'required',
            'description' => 'required|string',
            'price' => 'required',
            'no_power_price' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg',
            'product_image_album.*' => 'image|mimes:jpeg,png,jpg',
            'product_image_album' => 'nullable',
        ];
    }
}
