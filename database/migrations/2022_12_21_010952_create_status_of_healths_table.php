<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusOfHealthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_of_healths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_record_id')->constrained()->onUpdate('cascade');
            $table->foreignId('disease_id')->constrained()->onUpdate('cascade');
            $table->string('disease_remark')->nullable();
            $table->string('disease_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_of_healths');
    }
}
