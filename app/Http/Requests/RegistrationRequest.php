<?php

namespace App\Http\Requests;

use App\Rules\DomainRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegistrationRequest
 * @package App\Http\Requests
 */
class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'max:255'
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users',
                new DomainRule
            ],
            'password' => [
                'required',
                'min:6',
                'confirmed'
            ]
        ];
    }
}
