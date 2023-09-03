<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('billing_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            // Add more columns for additional billing details as needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('billing_details');
    }
}

