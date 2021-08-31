<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Category;
use App\Models\Bid;
use App\Models\Auction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
class BidFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bid::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'user_id'=> User::pluck('id')->random(),
            'auction_id'=> Auction::pluck('id')->random(),
            'bidding_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'bidding_price'=>$this->faker->numberBetween($min = 1000, $max = 9000)
        ];
    }
}
