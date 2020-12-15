<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class General extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('General', function (Blueprint $table) {
            $table->id();
  
            $table->longText('address',1000)->nullable();
            $table->longText('address2',1000)->nullable();
            $table->longText('phone',1000)->nullable();
            $table->longText('howtoBid',1000)->nullable();
            $table->string('howtoBidimg',200)->nullable();
             
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
         Schema::dropIfExists('General');
    
    }
}
