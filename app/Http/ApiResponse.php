<?php

declare(strict_types=1);

namespace App\Http;

use Illuminate\Http\JsonResponse;
use Kazemmdev\HttpStatus\Http;

trait ApiResponse
{
    protected function success(mixed $data, int $code): JsonResponse
    {
        $payload = is_string($data) ? ["message" => $data] : ["payload" => $data];
        return response()->json(array_merge(['status' => 'Success'], $payload), $code ?: Http::OK());
    }

    protected function error(string $message, int $code, array $errors = null): JsonResponse
    {
        $response = ['status' => 'Error', 'message' => $message,];

        if ($errors) {
            $response = array_merge($response, ['errors' => $errors]);
        }

        return response()->json($response, $code ?: Http::NOT_FOUND());
    }
}
