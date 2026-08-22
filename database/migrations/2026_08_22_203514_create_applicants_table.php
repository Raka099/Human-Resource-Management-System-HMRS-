<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();

            $table->string('application_number', 30)->unique();

            $table->string('full_name', 150);

            $table->string('email', 150);

            $table->string('phone', 20)->nullable();

            $table->text('address')->nullable();

            $table->string('cv_file')->nullable();

            $table->enum('status', [
                'Proses',
                'Diterima',
                'Tidak Diterima',
            ])->default('Proses');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};