<?php

declare(strict_types=1);

namespace Modules\Users\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int    $id
 * @property string $email
 * @property string $name
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id"    => $this->id,
            "email" => $this->email,
            "name"  => $this->name,
        ];
    }
}
