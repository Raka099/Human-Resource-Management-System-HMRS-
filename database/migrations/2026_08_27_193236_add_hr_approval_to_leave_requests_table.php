<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leave_requests', function (Blueprint $table) {

            $table->string('manager_status')
                ->default('Pending')
                ->after('status');

            $table->text('manager_note')
                ->nullable()
                ->after('manager_status');

            $table->timestamp('manager_approved_at')
                ->nullable()
                ->after('manager_note');

            $table->string('hr_status')
                ->default('Pending')
                ->after('manager_approved_at');

            $table->text('hr_note')
                ->nullable()
                ->after('hr_status');

            $table->timestamp('hr_approved_at')
                ->nullable()
                ->after('hr_note');
        });
    }

    public function down(): void
    {
        Schema::table('leave_requests', function (Blueprint $table) {

            $table->dropColumn([
                'manager_status',
                'manager_note',
                'manager_approved_at',
                'hr_status',
                'hr_note',
                'hr_approved_at',
            ]);

        });
    }
};