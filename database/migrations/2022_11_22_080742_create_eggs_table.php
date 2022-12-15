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
        Schema::create('eggs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->foreignId('type_id')->index();
            $table->foreignId('mating_id')->index()->nullable();
            $table->enum('is_hatching', ['y','n','w'])->default('w')->comment("y : 해칭완료, n : 해칭실패, w : 대기");
            $table->timestamp('spawn_at');
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
        Schema::dropIfExists('eggs');
    }
};
