<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id'    => 2,
            'sku'            => 'usa-iphone-12',
            'product_name'   => 'Iphone 12',
            'slug'           => 'iphone-12',
            'model_no'       => '12',
            'grade'          => 'A1',
            'specification'  => 'Super Retina XDR OLED, HDR10, Dolby Vision, 625 nits (typ), 1200 nits (peak)',
            'description'    => '5G speed. A14 Bionic, the fastest chip in a smartphone.
            An edge-to-edge OLED display. Ceramic Shield with four times better drop performance. And Night mode on every camera. iPhone 12 has it all — in two perfect sizes.',
            'expected_value' => 12000.00,
            'percentage'     => 20.0,
            'base_price'     => 10000.00,
            'front_image'    => 'images/products/front_image_iphone_12.jpg',
            'back_image'     => 'images/products/back_image_iphone_12.jpg',
            'left_image'     => 'images/products/left_image_iphone_12.jpg',
            'right_image'    => 'images/products/right_image_iphone_12.jpg',
        ]);
        Product::create([
            'category_id'    => 1,
            'sku'            => 'usa-imac-m1',
            'product_name'   => 'Imac M1',
            'slug'           => 'imac-m1',
            'model_no'       => 'm1',
            'grade'          => 'A1',
            'specification'  => 'Super Retina XDR OLED, HDR10, Dolby Vision, 625 nits (typ), 1200 nits (peak)',
            'description'    => '5G speed. A14 Bionic, the fastest chip in a smartphone.
            An edge-to-edge OLED display. Ceramic Shield with four times better drop performance. And Night mode on every camera. iPhone 12 has it all — in two perfect sizes.',
            'expected_value' => 12000.00,
            'percentage'     => 20.0,
            'base_price'     => 10000.00,
            'front_image'    => 'images/products/front_image_imac_m1.jpg',
            'back_image'     => 'images/products/back_image_imac_m1.jpg',
            'left_image'     => 'images/products/left_image_imac_m1.jpg',
            'right_image'    => 'images/products/right_image_imac_m1.jpg', 
        ]);
    }
}
