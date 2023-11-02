<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_applicant_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_record_id')->constrained()->onUpdate('cascade');
            $table->string('tempCode')->nullable();
            $table->string('studentCode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_applicant_details');
    }
};
