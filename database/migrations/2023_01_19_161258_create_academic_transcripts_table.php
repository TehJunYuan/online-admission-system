<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicTranscriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_transcripts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_record_id')->constrained()->onUpdate('cascade');
            $table->foreignId('supporting_document_id')->constrained()->onUpdate('cascade');
            $table->foreignId('school_level_id')->constrained()->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_transcripts');
    }
}
