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

        $a = [
            'id' => 1,
            'refresh_token_key' => 'refresh_token_key',
            'user' => [
                'id' => 1,
                'email' => 'ahsoka.tano@q.agency',
                'name' => 'bla'
            ]
        ];

        return $this->userFactory->createUser($a);
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

