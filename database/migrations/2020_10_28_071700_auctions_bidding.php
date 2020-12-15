<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AuctionsBidding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AuctionsBidding', function (Blueprint $table) {
            $table->id();
            $table->integer('ac_parent_id');
            $table->integer('ac_parent_child_id');
            $table->integer('user_id');
            $table->double('amount'); 
            $table->datetime('bdatetime',0);
            $table->enum('win', ['on','off'])->default('off');
            $table->enum('status', ['on','off'])->default('on');
            $table->enum('sold', ['on','off'])->default('off');
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
        Schema::dropIfExists('AuctionsBidding');
    }
}
