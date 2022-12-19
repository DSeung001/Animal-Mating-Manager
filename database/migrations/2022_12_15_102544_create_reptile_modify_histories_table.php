<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('reptile_modify_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->foreignId('reptile_id')->index();
            $table->enum('column',['g','s'])->comment("g: gender, s:status");
            $table->enum('type',['m','f','u','g','i','o','s','d'])->comment('reptile 의 모든 enum 값');
            $table->smallInteger('number')->comment("증감 값");
            $table->timestamp('created_at')->index()->default(DB::raw('CURRENT_TIMESTAMP'))->comment("생성일");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reptile_modify_histories');
    }
};
