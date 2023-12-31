<?php

declare(strict_types=1);

namespace Modules\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email"    => "required|email|exists:users,email",
            "password" => "required|string"
        ];
    }
}
