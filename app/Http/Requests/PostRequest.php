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
      'title' => 'required|string|max:255',
      'category' => 'nullable|string',
      'description' => 'nullable|string',
      'visit_time' => 'nullable|in:morning,afternoon,evening,night',
      'status' => 'nullable|in:public,private',
      'latitude' => 'nullable|numeric',
      'longitude' => 'nullable|numeric',
      'image' => 'nullable|image|max:2048',
    ];
  }
}
