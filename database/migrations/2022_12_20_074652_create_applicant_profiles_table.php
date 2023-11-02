<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('birth_date');
            $table->string('place_of_birth');
            $table->foreignId('gender_id')->constrained()->onUpdate('cascade');
            $table->foreignId('marital_id')->constrained()->onUpdate('cascade');
            $table->foreignId('race_id')->constrained()->onUpdate('cascade');
            $table->foreignId('nationality_id')->constrained()->onUpdate('cascade');
            $table->foreignId('religion_id')->constrained()->onUpdate('cascade');
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
        Schema::dropIfExists('applicant_profiles');
    }
}
