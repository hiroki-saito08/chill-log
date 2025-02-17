<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rating_overall' => 'sometimes|integer|min:1|max:5',
            'rating_silence' => 'sometimes|integer|min:1|max:5',
            'rating_relax' => 'sometimes|integer|min:1|max:5',
            'rating_safety' => 'sometimes|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ];
    }
}
