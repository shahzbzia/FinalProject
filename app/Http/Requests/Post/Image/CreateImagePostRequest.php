<?php

namespace App\Http\Requests\Post\Image;

use Illuminate\Foundation\Http\FormRequest;

class CreateImagePostRequest extends FormRequest
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
            'mainImage' => 'required|image', 
            'sellable' => 'nullable|string',
            'royaltyFee' => 'nullable|numeric',
            'dContent' => 'nullable|file|mimes:zip', 
        ];
    }
}
