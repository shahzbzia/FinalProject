<?php

namespace App\Http\Requests\Post\Video;

use Illuminate\Foundation\Http\FormRequest;

class CreateVideoPostRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string', 
            'description'  => 'nullable|string', 
            'sellable' => 'nullable|string',
            'royaltyFee' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'dContent' => 'nullable|file|mimes:zip', 
        ];
    }
}
