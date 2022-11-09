<?php

namespace App\Http\Client;

use Illuminate\Support\Facades\Http;

class QClient
{
    public function authenticate(string $email, string $password)
    {
        $response = Http::post("https://symfony-skeleton.q-tests.com/api/v2/token", [
            'email' => $email,
            'password' => $password
        ]);

        if ($response->status() !== 200) {
            return null;
        }

        return json_decode($response->body(), true);
    }

    public function refreshToken(string $token)
    {
        $response = Http::get("https://symfony-skeleton.q-tests.com/api/v2/token/refresh/$token");

        if ($response->status() !== 200) {
            return null;
        }

        return json_decode($response->body(), true);
    }

    public function getAuthors(string $token, array $params = [])
    {
        $queryParams = $this->buildParams($params);

        $response = Http::withToken($token)->get("https://symfony-skeleton.q-tests.com/api/v2/authors", $queryParams);

        if ($response->status() !== 200) {
            return null;
        }

        return json_decode($response->body(), true);
    }

    public function getAuthor(string $token, int $authorId)
    {
        $response = Http::withToken($token)->get("https://symfony-skeleton.q-tests.com/api/v2/authors/$authorId");

        if ($response->status() !== 200) {
            return null;
        }

        return json_decode($response->body(), true);
    }

    public function createAuthor(string $token, array $params)
    {
        $queryParams = $this->buildParams($params);

        $response = Http::withToken($token)->post("https://symfony-skeleton.q-tests.com/api/v2/authors", $queryParams);

        if ($response->status() !== 200) {
            return null;
        }

        return json_decode($response->body(), true);
    }

    public function deleteAuthor(string $token, int $authorId)
    {
        $response = Http::withToken($token)->delete("https://symfony-skeleton.q-tests.com/api/v2/authors/$authorId");

        if ($response->status() !== 204) {
            return null;
        }

        return json_decode($response->body(), true);
    }

    public function createBook(string $token, array $params)
    {
        $queryParams = $this->buildParams($params);

        $response = Http::withToken($token)->post("https://symfony-skeleton.q-tests.com/api/v2/books", $queryParams);

        if ($response->status() !== 200) {
            return null;
        }

        return json_decode($response->body(), true);
    }

    public function deleteBook(string $token, int $bookId)
    {
        $response = Http::withToken($token)->delete("https://symfony-skeleton.q-tests.com/api/v2/books/$bookId");

        if ($response->status() !== 204) {
            throw new \Exception('Error deleting book.');
        }
    }

    private function buildParams(array $params)
    {
        $data = [];

        foreach ($params as $key => $param) {
            $data[$key] = $param;
        }

        return $data;
    }
}

