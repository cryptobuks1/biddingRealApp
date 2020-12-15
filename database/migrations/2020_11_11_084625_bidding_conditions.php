<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BiddingConditions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BiddingConditions', function (Blueprint $table) {
            $table->id();
            $table->integer('ac_parent_id')->nullable();
            $table->integer('ac_parent_child_id');
            $table->double('inc_amount');
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
        Schema::dropIfExists('BiddingConditions');
    }
}
