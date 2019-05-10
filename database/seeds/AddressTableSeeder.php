<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zips = ['21011719', '23548-007', '23555-240', '23548-163'];

        foreach ($zips as $zip) {
            DB::table('addresses')->insert([
                'zip' => $zip,
                'number' => rand(10,100)
            ]);
        }
    }
}
