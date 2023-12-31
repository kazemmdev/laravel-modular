<?php

namespace Shared\Passport\Traits;

trait HttpCookie
{
    protected function setHttpOnlyCookie(string $token, int $expires = 10): void
    {
        setcookie(
            'xsrf_https',
            $token,
            time() + $expires * 24 * 60 * 60,
            "/",
            "",
            false,
            true
        );
    }
}
