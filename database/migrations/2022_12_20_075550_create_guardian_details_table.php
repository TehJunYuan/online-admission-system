<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardian_details', function (Blueprint $table) {
            $table->id();
            $table->string('occupation')->nullable();
            // $table->foreignId('income_id')->constrained()->onUpdate('cascade');
            $table->string('income');
            $table->foreignId('guardian_relationship_id')->constrained()->onUpdate('cascade');
            $table->foreignId('nationality_id')->constrained()->onUpdate('cascade');
            $table->foreignId('user_detail_id')->constrained()->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardian_details');
    }
}
