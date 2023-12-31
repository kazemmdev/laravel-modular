<?php

declare(strict_types=1);

namespace Shared\Passport\Exceptions;

use App\Exceptions\Contract\ApiException;
use Kazemmdev\HttpStatus\Http;

class TokenExpiredException extends ApiException
{
    public function __construct()
    {
        parent::__construct();

        $this->message = __('auth.expired');
        $this->code    = Http::UNAUTHORIZED();
    }
}
