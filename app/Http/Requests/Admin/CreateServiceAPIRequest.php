<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceAPIRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'service_id' => ['nullable', 'string'],
            'service_name' => ['nullable', 'string'],
            'service_desc' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ];
    }
}
