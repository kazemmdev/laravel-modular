<?php

declare(strict_types=1);

namespace Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Kazemmdev\HttpStatus\Http;
use Modules\Users\Requests\LoginRequest;
use Modules\Users\UserService;
use Shared\Passport\Exceptions\UnAuthenticateException;

class LoginController extends Controller
{
    /**
     *
     * @param LoginRequest $request
     * @param UserService  $service
     *
     * @return JsonResponse
     * @throws UnAuthenticateException
     */
    public function __invoke(LoginRequest $request, UserService $service): JsonResponse
    {
        return $this->success(
            data: $service->login($request->validated()),
            code: Http::ACCEPTED()
        );
    }
}
