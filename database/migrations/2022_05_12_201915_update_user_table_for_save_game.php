<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTableForSaveGame extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->string("buildIndex")->default(0)->nullable();
            $table->string("hasPistol")->default(0)->nullable();
            $table->string("hasAxe")->default(0)->nullable();
            $table->string("health")->default(0)->nullable();
            $table->string("x")->default(0)->nullable();
            $table->string("y")->default(0)->nullable();
            $table->string("z")->default(0)->nullable();
            $table->string("progress")->default(0)->nullable();
            $table->string("monsterKilled")->default(0)->nullable();
            $table->string("deathCount")->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
