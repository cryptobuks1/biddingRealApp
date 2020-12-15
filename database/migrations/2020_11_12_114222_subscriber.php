<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subscriber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('Subscriber', function (Blueprint $table) {
            $table->id();
            $table->string('email',200);
            $table->longText('description',1000)->nullable();
            $table->dateTime('create_datetime', 0);
            $table->enum('status', ['on','off'])->default('on');
            $table->enum('is_softdel', ['yes','no'])->default('no');
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
          Schema::dropIfExists('Subscriber');
    }
}
