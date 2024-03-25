<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorepostRequest extends FormRequest
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
            // 'user_id' => ['string', 'max:255'],
            // 'status' => ['string', 'max:255'],
            // 'title' => ['string', 'max:255'],
            // 'content' => ['string', 'max:255'],
            // 'image_id' => ['string', 'max:255'],
        ];
    }
}
