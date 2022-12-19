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
            $table->foreignId('user_id');
            $table->foreignId('reptile_id');
            $table->enum('column',['g','s'])->comment("g: gender, s:status")->index();
            $table->enum('plus',['m','f','u','g','i','o','s','d'])->comment('column 증가 값')->index();
            $table->enum('minus',['m','f','u','g','i','o','s','d'])->comment('column 감소 값')->index();
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
