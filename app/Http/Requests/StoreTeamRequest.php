<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
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
            'name'      => 'required',
            'position'  => 'required',
            'email'     => 'required|email|unique:teams,email',
            'adjective' => 'required|string|max:255',
            'facebook_url' => 'required|url|max:255',
            'linkedin_url' => 'required|url|max:255',
            'instagram_url' => 'required|url|max:255',
            'twitter_url' => 'required|url|max:255',
            'pinterest_url' => 'required|url|max:255',
            'phone'     => 'required|regex:/^[0-9+\s()-]+$/|min:10|max:20',
            'image'     => 'required|image|mimes:jpeg,png,jpg,webp,avif|max:300',
            'is_active' => 'required|in:0,1',
        ];
    }
}
