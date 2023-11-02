<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammePickedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programme_pickeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_record_id')->constrained()->onUpdate('cascade');
            $table->foreignId('programme_record_id')->constrained()->onUpdate('cascade');
            $table->foreignId('choice_priority_id')->constrained()->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programme_pickeds');
    }
}
