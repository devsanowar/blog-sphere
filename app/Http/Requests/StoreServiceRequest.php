<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'room_category_id'  => 'required',
            'cottage_type'      => 'bail|required|string|max:255',
            'description'       => 'required|string|min:10',
            'area'              => 'required',
            'holiday_price'     => 'required',
            'regular_price'     => 'required',
            'number_of_guest'   => 'required',
            'image_one'         => 'required|image|mimes:jpeg,png,jpg,webp|max:200',
            'image_two'         => 'required|image|mimes:jpeg,png,jpg,webp|max:200',
            'is_active'         => 'required|in:0,1',
        ];
    }
}
