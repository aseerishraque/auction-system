<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auction;
class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auction::create([
            'product_id'        => 1,
            'category_id'        => 1,
            'start_time' => '2018-08-26',
            'close_time'  => '2018-09-26',
            'result_time'  => '2018-10-26',
            'user_id'     => 2,
            'winner_bid' => 12000,
            'status' => 0,
            'is_delivered' => 1,
            'paying_time'  => '2018-11-26',
            'deleted_at' => now(),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        Auction::create([
            'product_id'        => 2,
            'category_id'        => 2,
            'start_time' => '2021-08-26',
            'close_time'  => '2021-08-27',
            'result_time'  => '2021-8-28',
            'user_id'     => 2,
            'winner_bid' => 12000,
            'status' => 0,
            'is_delivered' => 0,
            'paying_time'  => '2021-08-29',
            'deleted_at' => now(),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        
    }
}
