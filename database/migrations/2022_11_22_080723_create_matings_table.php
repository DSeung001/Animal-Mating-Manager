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
        Schema::create('matings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->index();
            $table->foreignId('user_id')->index();
            $table->foreignId('father_id')->index();
            $table->foreignId('mather_id')->index();
            $table->string('comment', 512)->nullable();
            $table->timestamp('mating_at');
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
        Schema::dropIfExists('matings');
    }
};
