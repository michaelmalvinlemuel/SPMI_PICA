<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhysicalAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_addresses', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('physical_address_category_id')->unsigned()->nullable();
            $table->foreign('physical_address_category_id', 'frg_pac_pa')->references('id')->on('physical_address_categories')->onDelete('cascade');
            
            $table->string('code');
            $table->string('description');
            
            $table->integer('physical_address_id')->unsigned()->nullable();
            $table->foreign('physical_address_id', 'frg_pa_pa')->references('id')->on('physical_addresses')->onDelete('cascade');
            
            //$table->unique(['physical_address_category_id', 'physical_address_id', 'deleted_at'],'unique_pa');
            
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
        Schema::drop('physical_addresses');
    }
}
