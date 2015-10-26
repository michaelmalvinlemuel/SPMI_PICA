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
        DB::unprepared("
            DELETE FROM mysql.event
                WHERE db = '" . env('DB_DATABASE', 'forge') . "';
        ");
        DB::unprepared("
            DELETE FROM mysql.proc
                WHERE db = '" . env('DB_DATABASE', 'forge') . "';
        ");
        
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik', 16);
            $table->string('name');
            $table->date('born');
            $table->string('address');
            $table->string('email');
            $table->string('password', 60);
            $table->char('type',1)->nullable();
            $table->char('status', 1);
            $table->unique(['nik', 'email', 'deleted_at']);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        
        //$myfile = fopen("testfile.txt", "w");
        
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
