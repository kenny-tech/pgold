<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('rates')->insert([
            // Crypto rates
            [
                'type' => 'crypto',
                'asset' => 'BTC',
                'rate' => 80000000, // ₦80m per BTC
            ],
            [
                'type' => 'crypto',
                'asset' => 'ETH',
                'rate' => 4500000, // ₦4.5m per ETH
            ],

            // Gift card rates
            [
                'type' => 'giftcard',
                'asset' => 'Amazon',
                'rate' => 600, // ₦600 per $1
            ],
            [
                'type' => 'giftcard',
                'asset' => 'iTunes',
                'rate' => 550, // ₦550 per $1
            ],
        ]);
    }
}
