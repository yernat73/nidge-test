<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => remove_non_digit_chars($this->get('phone'))
        ]);
    }

    public function rules(): array
    {
        return [
            'phone' => [
                'required',
                'string',
                'max:255',
                'digits:11',
                'unique:users,phone'
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}