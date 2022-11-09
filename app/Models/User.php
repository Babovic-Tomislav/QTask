<?php

namespace App\Models;

use App\Traits\MagicSetterAndGetterTrait;
use Illuminate\Contracts\Auth\Authenticatable;

class User implements Authenticatable
{
    use MagicSetterAndGetterTrait;

    private string $email;
    private string $name;
    private string $lastName;
    private string $rememberToken = '';
    private string $refreshTokenKey = '';
    private string $tokenKey = '';

    public function getAuthIdentifierName()
    {
        return 'email';
    }

    public function getAuthIdentifier()
    {
        return $this->email;
    }

    public function getAuthPassword()
    {
        return;
    }

    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    public function setRememberToken($value)
    {
        $this->rememberToken = $value;
    }

    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }
}
