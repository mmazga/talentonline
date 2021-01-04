<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PaymentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_types')->insert([
            'type' => 'Наличные'
        ]);
        DB::table('payment_types')->insert([
            'type' => 'Картой курьеру'
        ]);
    }
}
