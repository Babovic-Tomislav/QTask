<?php

namespace App\Transformer;

use App\Contract\AuthorSelectTransformerInterface;

class AuthorSelectTransformer implements AuthorSelectTransformerInterface
{

    public function single(array $data)
    {
        return [
            $data['id'] => $data['first_name'] . ' ' . $data['last_name']
        ];
    }

    public function list(array $data)
    {
        $return = [];

        foreach ($data as $author) {
            $return []= $this->single($author);
        }

        return $return;
    }
}

