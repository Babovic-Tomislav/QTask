<?php

namespace App\Contract;

interface AuthorSelectTransformerInterface
{
    public function single(array $data);
    public function list(array $data);
}