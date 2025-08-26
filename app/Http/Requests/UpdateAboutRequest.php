<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutRequest extends FormRequest
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
            'about_title'       => 'required',
            'about_sub_title'   => 'required',
            'description'       => 'required|string|min:10',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:300',
        ];
    }
}
