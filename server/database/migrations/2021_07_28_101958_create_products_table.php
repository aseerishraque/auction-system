<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->string('product_name');
            $table->string('slug');
            $table->string('model_no');
            $table->string('grade');
            $table->string('sku')->unique();
            $table->longText('specification');
            $table->longText('description');
            $table->integer('base_price');
            $table->integer('expected_value');
            $table->float('percentage');
            $table->string('front_image');
            $table->string('back_image');
            $table->string('left_image');
            $table->string('right_image');
            $table->tinyInteger('is_sold')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
