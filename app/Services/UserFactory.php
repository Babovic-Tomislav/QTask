<?php

namespace App\Services;

class UserFactory
{
    public function __construct(private string $userClass)
    {
    }

    public function createUser(array $data)
    {
        $user = new $this->userClass();

        if (array_key_exists('refresh_token_key', $data)) {
            $user->setRefreshTokenKey = $data['refresh_token_key'];
        }

        if (array_key_exists('token_key', $data)) {
            $user->setTokenKey($data['token_key']);
        }

        if (array_key_exists('user', $data)) {
            if (array_key_exists('email', $data['user'])) {
                $user->setEmail($data['user']['email']);
            }

            if (array_key_exists('first_name', $data['user'])) {
                $user->setName($data['user']['first_name']);
            }
        }

        return $user;
    }
}

