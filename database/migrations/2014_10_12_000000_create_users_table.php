<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->from(2);
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('parent_id')->default(0);
            $table->string('business_name')->nullable();
            $table->string('vat_number',200)->nullable();
             $table->string('fname',200)->nullable();
              $table->string('cname',200)->nullable();
             $table->string('image',300)->nullable();
             $table->string('country',300)->nullable(); 
            $table->string('address',200)->nullable();
            $table->string('type')->nullable();
            $table->string('phone')->nullable();
            $table->enum('terms', ['on','off'])->default('off');
            $table->integer('role_id')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
