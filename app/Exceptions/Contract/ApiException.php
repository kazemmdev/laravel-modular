<?php

namespace App\Exceptions\Contract;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\ApiResponse;

class ApiException extends Exception
{
    use ApiResponse;

    public function render(): JsonResponse
    {
        return $this->error($this->getMessage(), $this->getCode());
    }
}
