<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['nullable', 'string', 'max:50'],
            'bio' => ['nullable', 'string', 'max:500'],
            'clear_bio' => ['boolean'],
            'new_password' => ['nullable', 'confirmed', 'min:6'],
            'profile_image' => ['nullable', 'image', 'max:2048'], // 2MBまで
        ];
    }
}
