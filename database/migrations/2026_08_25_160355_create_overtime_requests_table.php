<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('overtime_requests', function (Blueprint $table) {

            $table->id();

            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnDelete();

            $table->date('overtime_date');

            $table->time('start_time');

            $table->time('end_time');

            $table->text('reason');

            $table->string('attachment')->nullable();

            $table->enum('status', [
                'Pending',
                'Approved',
                'Rejected'
            ])->default('Pending');

            $table->text('manager_note')->nullable();

            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('overtime_requests');
    }
};