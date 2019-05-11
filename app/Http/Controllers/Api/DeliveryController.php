<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
{
    public function __construct(Delivery $delivery)
    {
        $this->delivery = $delivery;
    }

    /**
     * Find Delivery .
     *
     * @param  Request  $request
     * @param  integer  $id
     * @return Response
     */
    public function find(Request $request, $id)
    {

        $data = ['id' => $id];
        $validatedData =  Validator::make($data, [
            'id' => 'required|integer'
        ]);

        if (count($validatedData->errors()) == 0) {
            $delivery = $this->delivery::find($id);
            if(!empty($delivery)) {
                $delivery->Client;
                $delivery->Addresses;
            }
            else
                return  response()->json(['error' => 'delivery_not_found'], 404);

            return response()->json(['deliverys' => $delivery], 200);
        }

        return response()->json(['error' => $validatedData->errors()], 404);


    }
    /**
     * List all Deliveries.
     *
     */
    public function getAll()
    {

        $deliveries = $this->delivery::all();
        if(count($deliveries) > 0) {
            foreach ($deliveries as $delivery) {
                $delivery->Client;
                $delivery->Addresses;
            }

            return response()->json(['deliverys' => $deliveries], 200);
        }

        return  response()->json(['error' => 'delivery_not_found'], 404);

    }
}
