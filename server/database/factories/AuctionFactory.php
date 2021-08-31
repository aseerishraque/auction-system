<?php

namespace Database\Factories;
use App\Models\Product;
use App\Models\Category;
use App\Models\Auction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
class AuctionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Auction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::pluck('id')->random(),
            'category_id' => Category::pluck('id')->random(),
            'start_time' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'close_time' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'result_time' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'user_id'=> User::pluck('id')->random(),
            'winner_bid'=>$this->faker->numberBetween($min = 1000, $max = 9000),
            'status'=>$this->faker->randomElement($array = array (0,1,2)),
            'is_delivered'=>$this->faker->randomElement($array = array (0,1)),
            'paying_time'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
