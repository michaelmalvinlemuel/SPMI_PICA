<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhysicalAddressCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_address_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('physical');
            $table->integer('physical_address_category_id')->unsigned()->nullable();
            $table->foreign('physical_address_category_id', 'frg_pac_pac')->references('id')->on('physical_address_categories')->onDelete('cascade');
            
            $table->unique(['physical_address_category_id', 'deleted_at'], 'unique_pac');
            
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
        Schema::drop('physical_address_categories');
    }
}
