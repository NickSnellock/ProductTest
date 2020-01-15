<?php

Namespace App\Comms;

use App\Exceptions\ProductListException;
use Exception;
use GuzzleHttp\Client;

class Comms
{
    const ROOT_URL = 'https://www.itccompliance.co.uk/recruitment-webservice/api/';
    var $client;

    public function __construct(?Client $client)
    {
        if ($client === null) {
            $this->client = new Client();
        } else {
            $this->client = $client;
        }
    }

    /**
     * @return array
     * @throws ProductListException
     * @throws Exception
     */
    public function getList(): array
    {
        $details = $this->getUntilNoError(self::ROOT_URL . 'list');

        if (!array_key_exists('products', $details)) {
            throw new ProductListException('Invalid value returned for list:' . PHP_EOL . print_r($details, true));
        }

        return $details['products'];
    }

    /**
     * @param string $uri
     * @return array
     * @throws Exception
     */
    private function getUntilNoError(string $uri): array
    {
        do {
            $response = $this->client->request('GET', $uri);
            if ($response->getStatusCode() != 200) {
                throw new Exception('Error response received from API ' . $response->getStatusCode());
            }
            $details = json_decode($response->getBody(), true);
            if (json_last_error() != JSON_ERROR_NONE) {
                throw new Exception('Invalid json received from API ' . json_last_error());
            }
        } while (array_key_exists('error', $details) && $details['error'] == 'Data source error, please try again');

        return $details;
    }

    /**
     * @param string $productKey
     * @return array
     * @throws Exception
     */
    public function getProductDetail(string $productKey)
    {
        return $this->getUntilNoError(self::ROOT_URL . 'info?id=' . $productKey);
    }
}