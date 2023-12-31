<?php

namespace Shared\Passport;

use Kazemmdev\HttpStatus\Http;
use Laravel\Passport\Client as OClient;
use Shared\Passport\Exceptions\UnAuthenticateException;
use Shared\Passport\Traits\HttpCookie;
use Symfony\Component\HttpFoundation\Request;

class PassportService
{
    use HttpCookie;

    /**
     * @throws UnAuthenticateException
     */
    public function grantPasswordToken(array $params): mixed
    {
        return $this->makeRequest([
            'grant_type' => 'password',
            'username' => $params['email'],
            'password' => $params['password'],
        ]);
    }

    /**
     * @throws UnAuthenticateException
     */
    public function grantSocialToken($provider, $provider_token): mixed
    {
        return $this->makeRequest([
            'grant_type' => 'social',
            'social_provider' => $provider,
            'access_token' => $provider_token,
        ]);
    }

    /**
     * @throws UnAuthenticateException
     */
    public function grantPhoneVerificationToken(array $params): mixed
    {
        return $this->makeRequest([
            'grant_type' => 'phone',
            'phone_number' => $params['phone'],
            'verification_code' => $params['code'],
            'scope' => ''
        ]);
    }

    /**
     * @throws UnAuthenticateException
     */
    public function getRefreshToken(): mixed
    {
        $refreshToken = request()->cookie('xsrf_https');
        abort_unless($refreshToken, Http::FORBIDDEN(), __('auth.unauthorized'));

        return $this->makeRequest([
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        ]);
    }

    /**
     * @throws UnAuthenticateException
     */
    protected function makeRequest(array $request): mixed
    {
        $client = OClient::query()->where('name', 'users')->first();

        $proxy = Request::create('oauth/token', 'post', array_merge(
            $request,
            [
                'client_id' => $client->id,
                'client_secret' => $client->secret
            ]
        ));

        $response = json_decode(app()->handle($proxy)->getContent());

        if (!isset($response->refresh_token)) {
            throw new UnAuthenticateException();
        }

        $this->setHttpOnlyCookie($response->refresh_token);

        return $response;
    }
}
