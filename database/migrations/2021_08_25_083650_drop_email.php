<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(Schema::hasColumn('users', 'email'))
        {
            Schema::table('users', function (Blueprint $table){
                $table->dropColumn('email');
            });
        }
        if(Schema::hasColumn('users', 'email_verified_at'))
        {
            Schema::table('users', function (Blueprint $table){
                $table->dropColumn('email_verified_at');
            });

        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
