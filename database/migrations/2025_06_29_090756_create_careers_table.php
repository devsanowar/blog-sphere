<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('location');
            $table->string('job_type');
            $table->string('salary');
            $table->longText('description');
            $table->longText('responsibilities')->nullable();
            $table->longText('others_requirements')->nullable();
            $table->longText('educational_requirements')->nullable();
            $table->longText('experience_requirements')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
