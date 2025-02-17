<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'category' => 'sometimes|string',
            'latitude' => 'sometimes|numeric',
            'longitude' => 'sometimes|numeric',
            'description' => 'sometimes|nullable|string',
            'status' => 'sometimes|in:public,private',
            'images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
