<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->char('nik', 12);
            $table->string('name');
            $table->date('born');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->char('type',1);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        DB::unprepared("
            DELETE FROM mysql.event
                WHERE db = '" . env('DB_DATABASE', 'forge') . "';
        ");
        DB::unprepared("
            DELETE FROM mysql.proc
                WHERE db = '" . env('DB_DATABASE', 'forge') . "';
        ");
    }
}
