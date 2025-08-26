<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
            'slider_title'      => 'required|string|max:255',
            'slider_sub_title'  => 'required|string|max:255',
            'slider_description'=> 'required',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:500',
            'is_active'         => 'required|in:0,1',
        ];
    }
}
