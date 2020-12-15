<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class News extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('News', function (Blueprint $table) {
            $table->id();
            $table->string('title',200);
            $table->string('slug',200);
            $table->string('post_type',200);
            $table->string('featured_img',500);
            $table->string('org_name',500)->nullable();
            $table->longText('description',1000)->nullable();
            $table->integer('author')->nullable();
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
       Schema::dropIfExists('News');
    }
}
