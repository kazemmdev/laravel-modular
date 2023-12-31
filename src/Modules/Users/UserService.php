<?php

declare(strict_types=1);

namespace Modules\Users;

use Exception;
use Modules\Users\Resources\UserResource;
use Shared\Passport\Exceptions\TokenExpiredException;
use Shared\Passport\Exceptions\UnAuthenticateException;
use Shared\Passport\PassportService;

class UserService
{
    public function __construct(protected PassportService $service)
    {
    }

    public function login(array $credentials): array
    {
        if (!auth()->attempt($credentials)) {
            throw new UnAuthenticateException();
        }

        $grant = $this->service->grantPasswordToken($credentials);

        return [
            "user"         => $this->user(),
            "access_token" => $grant->access_token,
            "expires_in"   => $grant->expires_in
        ];
    }

    public function user(): UserResource
    {
        auth()->user()->update(['updated_at' => now()]);
        return new UserResource(auth()->user());
    }

    public function refresh(): array
    {
        try {
            $grant = $this->service->getRefreshToken();
            return [
                "access_token" => $grant->access_token,
                "expires_in"   => $grant->expires_in
            ];
        } catch (Exception $e) {
            throw new TokenExpiredException();
        }
    }
}
