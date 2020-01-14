<?php

namespace Tests\Comms;

use App\Comms\Comms;
use App\Exceptions\ProductListException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery;
use PHPUnit\Framework\TestCase;

class CommsTest extends TestCase
{

    public function testGetListFirstResponseOk()
    {
        $client = Mockery::mock(Client::class);
        $response = Mockery::mock(Response::class);
        $response->shouldReceive('getBody')->andReturn(
            json_encode(['products' => []])
        );
        $client->shouldReceive('request')->andReturn($response);

        /** @var  Comms $comms */
        $comms = new Comms($client);

        $data = $comms->getList();

        $this->assertIsArray($data);
    }

    public function testGetListFirstResponseIsError()
    {
        $client = Mockery::mock(Client::class);
        $response = Mockery::mock(Response::class);
        $response->shouldReceive('getBody')->andReturn(
            json_encode(['error' => 'Data source error, please try again']),
            json_encode(['products' => []])
        );
        $client->shouldReceive('request')->andReturn($response);

        /** @var  Comms $comms */
        $comms = new Comms($client);

        $data = $comms->getList();

        $this->assertIsArray($data);
        $this->assertNotEquals(['error' => 'Data source error, please try again'], $data);
    }

    public function testGetListFirstResponseHasNoProducts()
    {
        $client = Mockery::mock(Client::class);
        $response = Mockery::mock(Response::class);
        $response->shouldReceive('getBody')->andReturn(
            json_encode(['slartybartfast' => []])
        );
        $client->shouldReceive('request')->andReturn($response);

        /** @var  Comms $comms */
        $comms = new Comms($client);

        $this->expectException(ProductListException::class);
        $data = $comms->getList();
    }

    public function testGetProductDetail()
    {
        $client = Mockery::mock(Client::class);
        $response = Mockery::mock(Response::class);
        $response->shouldReceive('getBody')->andReturn(
            json_encode(['productId' => []])
        );
        $client->shouldReceive('request')->andReturn($response);

        /** @var  Comms $comms */
        $comms = new Comms($client);

        $data = $comms->getProductDetail('productId');

        $this->assertIsArray($data);
    }
}
