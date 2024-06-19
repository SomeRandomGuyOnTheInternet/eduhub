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
        Schema::create('modules', function (Blueprint $table) {
            $table->bigIncrements('module_id');
            $table->string('module_name', 100);
            $table->string('module_code', 10)->unique();
            $table->text('description')->nullable();
            $table->integer('credits');
            $table->string('logo', 255)->nullable();
            $table->unsignedBigInteger('faculty_id');
            $table->timestamps();

            $table->foreign('faculty_id')->references('faculty_id')->on('faculties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
