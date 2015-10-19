<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskUsersView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW task_users AS SELECT
                tasks.user_id
                , users.nik
                , users.name
                , users.born
                , users.address
                , users.type
            FROM
                spmilaravel.tasks
            INNER JOIN spmilaravel.users 
                ON (tasks.user_id = users.id)
            GROUP BY tasks.user_id
                , users.nik
                , users.name
                , users.born
                , users.address
                , users.type;
        ");
    }
    public function down()
    {
        DB::statement( 'DROP VIEW task_users' );
    }
}
