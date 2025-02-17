<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRankingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'post_id' => 'required|exists:posts,id',
            'rank_type' => 'required|string|in:weekly,monthly,yearly',
            'position' => 'required|integer|min:1',
        ];
    }
}
