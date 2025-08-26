<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest
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
//            'name'      => 'required',
//            'position'  => 'required',
//            'email'     => 'required|email|unique:teams,email',
//            'phone'     => 'required|regex:/^[0-9+\s()-]+$/|min:10|max:20',
//            'image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:300',
//            'is_active' => 'required|in:0,1',
        ];
    }
}
