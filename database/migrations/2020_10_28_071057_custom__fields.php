<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Custom_Fields', function (Blueprint $table) {
            $table->id();
            $table->string('name',200)->nullable();
            $table->string('slug',200)->nullable();
            $table->string('css_class',200)->nullable();
            $table->string('placeholder',200)->nullable();
            $table->string('required',200)->nullable();
            $table->string('css_id',200)->nullable();
            $table->string('post_type',200)->nullable();
            $table->string('field_type',200)->nullable();
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
        Schema::dropIfExists('Custom_Fields');
    }
}
