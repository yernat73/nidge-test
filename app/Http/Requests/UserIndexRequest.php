<?php

namespace App\Http\Requests;

use App\Enums\UserSortableAttributeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'sort_by' => [
                'nullable',
                'string',
                'max:255',
                Rule::in(UserSortableAttributeEnum::names()),
            ],
            'sort_desc' => [
                'nullable',
                'boolean',
            ],
            'page' => [
                'nullable',
                'integer',
                'min:0',
            ]
        ];
    }
}