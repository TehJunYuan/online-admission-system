<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportingDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // isCert = 0, false, isCert = 1, true

    public function up()
    {
        Schema::create('supporting_documents', function (Blueprint $table) {
            $table->id();
            $table->text('doc')->nullable();
            $table->boolean('isCert')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supporting_documents');
    }
}
