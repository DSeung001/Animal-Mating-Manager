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
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('father_id')->nullable();
            $table->unsignedBigInteger('mother_id')->nullable();
            $table->string('name', 128);
            $table->integer('age');
            $table->enum('gender', ['m','w','u'])->default('u')->comment('m: 수, w: 암, u: 미구분');
            $table->string('morph', 128);
            $table->timestamp('birth');
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
