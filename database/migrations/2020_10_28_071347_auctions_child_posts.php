<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AuctionsChildPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AuctionsChildPosts', function (Blueprint $table) {
            $table->id();
            $table->integer('ac_parent_id');
            $table->integer('user_id')->nullable();
            $table->string('title',200);
            $table->double('start_price'); 
            $table->string('slug',200);
            $table->string('post_type',200);
            $table->longText('gallery',1000)->nullable();
            $table->string('upload_video',500)->nullable();
            $table->string('video_link',500)->nullable();
            $table->longText('description',1000)->nullable();
            $table->dateTime('start_datetime', 0);
            $table->dateTime('end_datetime', 0);
            $table->enum('status', ['on','off'])->default('off');
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
        Schema::dropIfExists('AuctionsChildPosts');
    }
}
