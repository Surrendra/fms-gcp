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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('filename', 200)->nullable();
            $table->string('original_filename', 200)->nullable();
            $table->string('extension', 50)->nullable();
            $table->string('gcp_code', 50)->nullable();
            $table->json('payload_content')->nullable();
            $table->longText('content')->nullable();
            $table->bigInteger('created_user_id')->nullable();
            $table->json('ocr_response')->nullable();
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
        Schema::dropIfExists('files');
    }
};
