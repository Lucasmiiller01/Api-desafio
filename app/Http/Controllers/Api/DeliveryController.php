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

        $data = json_decode($request['payload'], true);

        if(!$data)
            return response()->json(['errors' => 'format_invalid'], 404);

        $validatedData =  Validator::make($data, [
            'nameClient' => 'required',
            'date' => 'required|date|date_format:Y-m-d',
            'zipStart' => 'required|integer',
            'numberStart' => 'required|integer',
            'zipEnd' => 'required|integer',
            'numberEnd' => 'required|integer'
        ]);

        if (count($validatedData->errors()) == 0) {

            $client = new Client();

            $client->name = $data['nameClient'];
            $client->save();
            $delivery = new $this->delivery;
            $delivery->delivery_date = $data['date'];
            $delivery->client_id = $client->id;
            $delivery->save();

            $checkAddressExits = Address::where('zip', $data['zipStart'])->where('number', $data['numberStart'])->first();
            $checkAddress1Exits = Address::where('zip', $data['zipStart'])->where('number', $data['numberStart'])->first();

            if(empty($checkAddressExits)) {
                $addressStart = new Address();
                $addressStart->zip = $data['zipStart'];
                $addressStart->number = $data['numberStart'];
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
                $addressEnd->zip = $data['zipEnd'];
                $addressEnd->number = $data['numberEnd'];
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
