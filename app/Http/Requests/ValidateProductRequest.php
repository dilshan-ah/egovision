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
            'diameter_id' => 'required',
            'base_curve_id' => 'required',
            'material_id' => 'required',
            
            'tone_id' => 'required',
            'lens_design_id' => 'required',
            'water_content_id' => 'required',
            'color_id' => 'required',
            'duration_id' => 'required',
            'product_intro' => 'required',
            'category_id' => 'required',
            'description' => 'required|string',
            'price' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg',
            'product_image_album.*' => 'image|mimes:jpeg,png,jpg',
            'product_image_album' => 'required',
        ];
    }
}
