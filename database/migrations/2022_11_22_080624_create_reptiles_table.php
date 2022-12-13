<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reptiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('father_id')->nullable();
            $table->unsignedBigInteger('mather_id')->nullable();
            $table->string('name', 128);
            $table->enum('gender', ['m','f','u'])->default('u')->comment('m: 수, f: 암, u: 미구분');
            $table->enum('status', ['s','d','g','o','i'])->comment('s: 분양, d: 사망, g: 키움, o: 위탁 반출, i: 위탁 반입');
            $table->string('morph', 128);
            $table->timestamp('birth')->nullable();
            $table->string('comment', 512)->nullable();
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
        Schema::dropIfExists('reptiles');
    }
};

