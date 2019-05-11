<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \GuzzleHttp\Client as Client;
class PassportTest extends TestCase
{
    /**
     *  test Login Passport Api Request.
     *
     * @return void
     */

    public function testLogin()
    {
        $client = new Client();
        $response = $client->request('POST', url('/oauth/token') , [
            'json' => [
                'grant_type' => 'password',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                "username" => "dev@mail.com",
	            "password"  => "secret"

            ],

        ]);


        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(true), true);

        $this->assertArrayHasKey('access_token', $data);
    }
}
