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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQ3MzBkMDgyMzY2ZWFhYmQ1MmFhOTZiNDYyN2I1MmJkNTI3NzYwYzM4YTg5M2RjZmVlZTQwNjcyOWQ3NmNlOWEzOTA4YjI0NzIzNjllOGQwIn0.eyJhdWQiOiIyIiwianRpIjoiZDczMGQwODIzNjZlYWFiZDUyYWE5NmI0NjI3YjUyYmQ1Mjc3NjBjMzhhODkzZGNmZWVlNDA2NzI5ZDc2Y2U5YTM5MDhiMjQ3MjM2OWU4ZDAiLCJpYXQiOjE1NTc1NDExMTYsIm5iZiI6MTU1NzU0MTExNiwiZXhwIjoxNTU3OTczMTE2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.jU2wWte3Sawp5H6Eu4hjXmVdyPl7qAHIZV1zumMTL8W7Cp_-RA_44ljZ64RuKBV8zAx0IO_klzvIhsLRGeEdMUHw6wNf13qX4dKd8yGbOhlVLCwpNOLjXGf8RclJrx_9fNH--2ftz6BqoY0JaBm3BMQFb39f1dZR_oAjbGDBFwEBD1Sgq9yI_JrucvyH8czR-H6ySYa_5fcIzLL8mX1TgBq3zErhhbPvLY1zz5oo4yuwbBIP2CPVayIyL3fdCev3okg5AH1ZfbgjU_ynhXnC70CEcR2Z_asFI137hLTsoLdTIWIBYNI4WKnl1f8m9hApbEvRBgkiNWJuqH1MXM85oXS1hQ3gKYZcBe9uzJciNvSMDnJawp3Rbtpb87WNeoXAG1w-u4oBa486OYZt6HzL-9zPb1En60Ji7-08_ovEdloTAcpnm0g-0LYBMxhfsU_YjEK_Qp1p_TOYDSTkOq7DLAuSynuIiuCXRXgK45v-22eDchxOmgTbvGaLnKCBj7N7usHuLCDY8OeUNt3j38D4hum5FLb9gjktxg7X9OW8yIWFu2n_tLflM9aBbvQw0sFa8dGs_XwEa7zKzCDxar_GGlvcmYACaSAcdFKbXP4nsPErMQkrZNguNudDlNqITY73J0krHiPlrBoGL9BZEZAiZAPxTN7wHKR_UhcFNKJfF_A';
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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQ3MzBkMDgyMzY2ZWFhYmQ1MmFhOTZiNDYyN2I1MmJkNTI3NzYwYzM4YTg5M2RjZmVlZTQwNjcyOWQ3NmNlOWEzOTA4YjI0NzIzNjllOGQwIn0.eyJhdWQiOiIyIiwianRpIjoiZDczMGQwODIzNjZlYWFiZDUyYWE5NmI0NjI3YjUyYmQ1Mjc3NjBjMzhhODkzZGNmZWVlNDA2NzI5ZDc2Y2U5YTM5MDhiMjQ3MjM2OWU4ZDAiLCJpYXQiOjE1NTc1NDExMTYsIm5iZiI6MTU1NzU0MTExNiwiZXhwIjoxNTU3OTczMTE2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.jU2wWte3Sawp5H6Eu4hjXmVdyPl7qAHIZV1zumMTL8W7Cp_-RA_44ljZ64RuKBV8zAx0IO_klzvIhsLRGeEdMUHw6wNf13qX4dKd8yGbOhlVLCwpNOLjXGf8RclJrx_9fNH--2ftz6BqoY0JaBm3BMQFb39f1dZR_oAjbGDBFwEBD1Sgq9yI_JrucvyH8czR-H6ySYa_5fcIzLL8mX1TgBq3zErhhbPvLY1zz5oo4yuwbBIP2CPVayIyL3fdCev3okg5AH1ZfbgjU_ynhXnC70CEcR2Z_asFI137hLTsoLdTIWIBYNI4WKnl1f8m9hApbEvRBgkiNWJuqH1MXM85oXS1hQ3gKYZcBe9uzJciNvSMDnJawp3Rbtpb87WNeoXAG1w-u4oBa486OYZt6HzL-9zPb1En60Ji7-08_ovEdloTAcpnm0g-0LYBMxhfsU_YjEK_Qp1p_TOYDSTkOq7DLAuSynuIiuCXRXgK45v-22eDchxOmgTbvGaLnKCBj7N7usHuLCDY8OeUNt3j38D4hum5FLb9gjktxg7X9OW8yIWFu2n_tLflM9aBbvQw0sFa8dGs_XwEa7zKzCDxar_GGlvcmYACaSAcdFKbXP4nsPErMQkrZNguNudDlNqITY73J0krHiPlrBoGL9BZEZAiZAPxTN7wHKR_UhcFNKJfF_A';
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
