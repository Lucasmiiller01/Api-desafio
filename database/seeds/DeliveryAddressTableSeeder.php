<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1 ; $i < 4; $i++) {
            DB::table('delivery_addresses')->insert([
                'delivery_id' => $i,
                'address_id' => $i,
                'type' => 'start'
            ]);

            DB::table('delivery_addresses')->insert([
                'delivery_id' => $i,
                'address_id' => $i,
                'type' => 'end'
            ]);
        }
    }
}
