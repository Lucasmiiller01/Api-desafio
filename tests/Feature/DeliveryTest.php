<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \GuzzleHttp\Client as Client;
class DeliveryTest extends TestCase
{
    /**
     * Test Find Delivery Request
     *
     * @return void
     */
    public function testFind()
    {
        $client = new Client();
        //Inserir um Token Valido
        $token = env('TOKEN_ACCESS_TEST');
        $response = $client->request('GET', url('/api/delivery/find/1') , [
            'headers' => [
                'Content-Type' => 'application/json',

                'Authorization' => "Bearer ". $token,
            ],

        ]);


        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(true), true);

        $this->assertArrayHasKey('deliverys', $data);
    }
    /**
     * List All deliverys Request
     *
     * @return void
     */
    public function testAllList()
    {
        $client = new Client();
        //Inserir um Token Valido
        $token = env('TOKEN_ACCESS_TEST');
        $response = $client->request('GET', url('/api/delivery/find/1') , [
            'headers' => [
                'Content-Type' => 'application/json',

                'Authorization' => "Bearer ". $token,
            ],

        ]);


        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(true), true);

        $this->assertArrayHasKey('deliverys', $data);
    }


}
