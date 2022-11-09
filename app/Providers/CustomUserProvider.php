<?php

namespace App\Providers;

use App\Http\Client\QClient;
use App\Services\UserFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class CustomUserProvider implements UserProvider
{
    public function __construct(
        private UserFactory $userFactory,
        private QClient $client
    ) {
    }

    public function retrieveById($identifier)
    {
        // TODO: Implement retrieveById() method.
    }

    public function retrieveByToken($identifier, $token)
    {
        $data = $this->client->refreshToken($token);

        return $this->userFactory->createUser($data);
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    public function retrieveByCredentials(array $credentials)
    {
        $data = $this->client->authenticate($credentials['email'], $credentials['password']);

        return $this->userFactory->createUser($data);
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return true;
    }
}

