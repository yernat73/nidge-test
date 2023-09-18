<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('user'),
            'phone' => remove_non_digit_chars($this->get('phone'))
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'phone' => [
                'required_without:name',
                'nullable',
                'string',
                'max:255',
                'digits:11',
                Rule::unique('users', 'phone')->ignore($this->route('user'))
            ],
            'name' => [
                'required_without:phone',
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }
}