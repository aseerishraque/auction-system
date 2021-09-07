<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile_no')->nullable();
            $table->string('account_type')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('nid_front_img')->nullable();
            $table->string('nid_back_img')->nullable();
            $table->string('vat_no')->nullable();
            $table->string('vat_img')->nullable();
            $table->integer('deposit')->nullable();
            $table->boolean('is_approved')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
