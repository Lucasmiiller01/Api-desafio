<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Client;
use App\Models\Address;
use App\Models\DeliveryAddress;
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
    /**
     * Save Delivey.
     * @param  Request  $request
     */
    public function save(Request $request)
    {

        $validatedData =  Validator::make($request->all(), [
            'nameClient' => 'required',
            'date' => 'required|date|date_format:Y-m-d',
            'zipStart' => 'required|integer',
            'numberStart' => 'required|integer',
            'zipEnd' => 'required|integer',
            'numberEnd' => 'required|integer'
        ]);

        if (count($validatedData->errors()) == 0) {

            $client = new Client();

            $client->name = $request['nameClient'];
            $client->save();
            $delivery = new $this->delivery;
            $delivery->delivery_date = $request['date'];
            $delivery->client_id = $client->id;
            $delivery->save();

            $checkAddressExits = Address::where('zip', $request['zipStart'])->where('number', $request['numberStart'])->first();
            $checkAddress1Exits = Address::where('zip', $request['zipStart'])->where('number', $request['numberStart'])->first();

            if(empty($checkAddressExits)) {
                $addressStart = new Address();
                $addressStart->zip = $request['zipStart'];
                $addressStart->number = $request['numberStart'];
                $addressStart->save();
                $addressStart = $addressStart->id;
            }
            else $addressStart = $checkAddressExits->id;

            $deliveryAddressStart = new DeliveryAddress();
            $deliveryAddressStart->delivery_id = $delivery->id;
            $deliveryAddressStart->address_id = $addressStart;
            $deliveryAddressStart->type = 'start';
            $deliveryAddressStart->save();

            if(empty($checkAddress1Exits)) {
                $addressEnd = new Address();
                $addressEnd->zip = $request['zipEnd'];
                $addressEnd->number = $request['numberEnd'];
                $addressEnd->save();
                $addressEnd = $addressEnd->id;
            }
            else {
                $addressEnd = $checkAddress1Exits->id;
            }

            $deliveryAddressEnd = new DeliveryAddress();
            $deliveryAddressEnd->delivery_id = $delivery->id;
            $deliveryAddressEnd->address_id = $addressEnd;
            $deliveryAddressEnd->type = 'end';
            $deliveryAddressEnd->save();



            return response()->json(['message' => 'success'], 200);
        }

        return response()->json(['error' => $validatedData->errors()], 404);

    }
}
