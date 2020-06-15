<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UpdateProfileRequest extends FormRequest
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
        $user = Auth::user();
        return [
            'firstName' => 'required|string', 
            'lastName'  => 'required|string', 
            //'email' => 'required|string|email|unique:users',
            //'password' => 'required|string|min:8|confirmed', 
            'countryCode' => 'required|string', 
            'number' => 'required|numeric|unique:users,number, '.$user->id, 
            'image' => 'nullable|image', 
            'coverImage' => 'nullable|image', 
            'theme_id' => 'required', 
            'address' => 'required|string', 
            'gender_id' => 'required', 
            'birthDate' => 'required|date|before:today', 
            'profession' => 'nullable|string', 
            //'userName' => 'required|string|unique:users',
            'aboutMe' => 'nullable|string',
        ];
    }
}
