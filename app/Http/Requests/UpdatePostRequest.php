<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string'],
            'location_name' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'description' => ['nullable', 'string'],
            'visit_time' => ['nullable', 'array'],
            'recommended_time.*' => ['in:morning,afternoon,evening,night,anytime'],
            'status' => ['required', 'in:public,private'],
            'images' => ['nullable', 'array', 'min:1'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }
}
