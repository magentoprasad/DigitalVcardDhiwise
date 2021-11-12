<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\BaseAPIResource;
use Illuminate\Http\Request;

class UserResource extends BaseAPIResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'name' => $this->name,
            'email_verified_at' => $this->email_verified_at,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'added_by' => $this->added_by,
            'updated_by' => $this->updated_by,
            'login_reactive_time' => $this->login_reactive_time,
            'login_retry_limit' => $this->login_retry_limit,
            'user_type' => $this->user_type,
        ];
    }
}
