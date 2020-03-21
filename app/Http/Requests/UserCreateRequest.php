<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
        public function rules()
        {
            return [
                'email' => 'required|email|unique:users',
                'name' => 'required|string|max:50',
                'password' => 'required|min:8|confirmed'
            ];
        }

        /**
         * Custom message for validation
         *
         * @return array
         */
        public function messages()
        {
            return [
                'email.required' => 'E-mail is verplicht!',
                'name.required' => 'Naam is verplicht!',
                'password.required' => 'Wachtwoord is verplicht!',
                'password.min' => 'Wachtwoord dient uit minimaal 8 karakters te bestaan!'
                'confirmed' => 'Wachtwoorden dienen gelijk te zijn!'
            ];
        }
    }
}
