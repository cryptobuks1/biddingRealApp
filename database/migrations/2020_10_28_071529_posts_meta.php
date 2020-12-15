<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PostsMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PostsMeta', function (Blueprint $table) {
            $table->id();
            $table->integer('post_id');
            $table->string('meta_key',200)->nullable();
            $table->longText('meta_value',500)->nullable();
            $table->string('post_type',500);
            $table->string('field_type',500)->nullable();
            $table->enum('status', ['on','off'])->default('on');
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
        Schema::dropIfExists('PostsMeta');
    }
}
