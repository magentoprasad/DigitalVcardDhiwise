<?php

namespace App\Http\Requests\Device;

use Illuminate\Foundation\Http\FormRequest;

class BulkCreateServiceAPIRequest extends FormRequest
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
            'data.*.service_id' => ['nullable', 'string'],
            'data.*.service_name' => ['nullable', 'string'],
            'data.*.service_desc' => ['nullable', 'string'],
            'data.*.is_active' => ['boolean'],
        ];
    }
}
