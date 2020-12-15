<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


          Schema::create('Contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name',200)->nullable();
            $table->string('email',200)->nullable();
            $table->string('subject',200)->nullable();
            $table->string('phone',200)->nullable();
            $table->longText('description',1000)->nullable();
            $table->dateTime('create_datetime', 0);
            $table->enum('is_agree', ['no','yes'])->default('no');
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
         Schema::dropIfExists('Contacts');
    }
}
