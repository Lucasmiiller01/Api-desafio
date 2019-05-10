<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
class ClientController extends Controller
{
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * get client api.
     *
     * @param  Request  $request
     * @param  integer  $id
     * @return Response
     */
    public function find(Request $request, $id)
    {
        return '1';
    }
}
