<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

class DogService
{
    const RANDOM_ENDPOINT = 'https://dog.ceo/api/breeds/image/random';
    const BREED_ENDPOINT = 'https://dog.ceo/api/breed/%s/images/random';
    const SUB_BREED_ENDPOINT = 'https://dog.ceo/api/breed/%s/%s/images/random';

    protected $client;

    public function __construct()
    {
        $this->client = new Client;
    }

    public function random()
    {
        try {
            //code...
            $response = json_decode(
                $this->client->get(self::RANDOM_ENDPOINT)->getBody()
            );

            return $response->message;

        } catch (Exception $e) {

            return 'An unexpected error occurred. Please try again later.';
        }
    }

    public function byBreed($breed)
    {
        try {
            //code...
            $endpoint = sprintf(self::BREED_ENDPOINT, $breed);
            
            $response = json_decode(
                $this->client-get($endpoint)->getBody()
            );

            return $response->message;
        } catch (Exception $e) {
            //throw $th;

            return "Sorry I couldn\"t get you any photos from $breed. Please try with a different breed.";

        }
    }

    public function bySubBreed($breed, $subBreed)
    {
        try {
            
            $endpoint = sprintf(self::SUB_BREED_ENDPOINT, $breed, $subBreed);

            $response = json_decode(
                $this->client->get($endpoint)->getBody()
            );

            return $response->message;
        } catch (Exception $e) {
            
            return $e;
        }
    }
}