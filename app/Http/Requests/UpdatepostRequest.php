<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatepostRequest extends FormRequest
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
            'form.status' => ['required', 'boolean'],
            'form.title' => ['required', 'string', 'max:20'],
            'form.content' => ['required', 'string', 'max:250'],
            'form.location' => ['required', 'array']
        ];
    }
}
