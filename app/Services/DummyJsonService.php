<?php

namespace App\Services;

use App\DTO\CreatePostDto;
use App\DTO\UpdatePostDto;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class DummyJsonService
{
    private Client $client;

    private array $headers;

    public function __construct()
    {
        $this->client = new Client();
        $this->headers = [
            'Content-Type' => 'application/json',
        ];
    }

    public function getPostDataById(int $id): array
    {
        try {
            $url = env('DUMMY_JSON_URL') . 'posts/' . $id;

            $response = $this->client->get(
                $url, [
                'headers' => $this->headers,
            ]);
            $responseBody = $response->getBody()->getContents();

            return json_decode($responseBody, true);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());

            return [];
        }
    }

    public function update(array $params, int $dummyPostId): array
    {
        try {
            $url = env('DUMMY_JSON_URL') . 'posts/' . $dummyPostId;

            $response = $this->client->put(
                $url, [
                'headers' => $this->headers,
                'body' => json_encode($params)
            ]);
            $responseBody = $response->getBody()->getContents();

            return json_decode($responseBody, true);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());

            return [];
        }
    }
}
