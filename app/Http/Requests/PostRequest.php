<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'title' => ['required', 'string', 'max:255'],
      'category' => ['required', 'string'],
      'location_name' => ['nullable', 'string', 'max:255'],
      'latitude' => ['nullable', 'numeric'],
      'longitude' => ['nullable', 'numeric'],
      'description' => ['nullable', 'string'],
      'visit_time' => 'nullable|in:morning,afternoon,evening,night,anytime',
      'status' => ['required', 'in:public,private'],
      'images.*' => ['nullable', 'image'],
    ];
  }
}
