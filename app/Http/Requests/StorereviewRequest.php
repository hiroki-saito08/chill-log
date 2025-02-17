<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rating_overall' => 'required|integer|min:1|max:5',
            'rating_silence' => 'required|integer|min:1|max:5',
            'rating_relax' => 'required|integer|min:1|max:5',
            'rating_safety' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ];
    }
}
