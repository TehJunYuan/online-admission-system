<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_detail_id')->constrained()->onUpdate('cascade');
            $table->foreignId('address_id')->constrained()->onUpdate('cascade');
            $table->foreignId('address_type_id')->constrained()->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_mappings');
    }
}
