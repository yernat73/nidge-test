<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomNotificationStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'message' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}