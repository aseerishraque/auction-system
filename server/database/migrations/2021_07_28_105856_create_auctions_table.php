<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->unique();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->timestamp('start_time', 0)->nullable();
            $table->timestamp('close_time', 0)->nullable();
            $table->timestamp('result_time', 0)->nullable();
            $table->foreignId('user_id')->nullable()->constrained(); 
            $table->integer('winner_bid')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('is_delivered')->default(0);
            $table->timestamp('paying_time', 0)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('auctions');
    }
}
