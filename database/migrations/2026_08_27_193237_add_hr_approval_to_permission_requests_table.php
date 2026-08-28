<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permission_requests', function (Blueprint $table) {

            if (!Schema::hasColumn('permission_requests', 'manager_status')) {
                $table->string('manager_status')
                    ->default('Pending')
                    ->after('status');
            }

            if (!Schema::hasColumn('permission_requests', 'manager_note')) {
                $table->text('manager_note')
                    ->nullable()
                    ->after('manager_status');
            }

            if (!Schema::hasColumn('permission_requests', 'manager_approved_at')) {
                $table->timestamp('manager_approved_at')
                    ->nullable()
                    ->after('manager_note');
            }

            if (!Schema::hasColumn('permission_requests', 'hr_status')) {
                $table->string('hr_status')
                    ->default('Pending')
                    ->after('manager_approved_at');
            }

            if (!Schema::hasColumn('permission_requests', 'hr_note')) {
                $table->text('hr_note')
                    ->nullable()
                    ->after('hr_status');
            }

            if (!Schema::hasColumn('permission_requests', 'hr_approved_at')) {
                $table->timestamp('hr_approved_at')
                    ->nullable()
                    ->after('hr_note');
            }
        });
    }

    public function down(): void
    {
        Schema::table('permission_requests', function (Blueprint $table) {

            $columns = [
                'manager_status',
                'manager_note',
                'manager_approved_at',
                'hr_status',
                'hr_note',
                'hr_approved_at',
            ];

            foreach ($columns as $column) {

                if (Schema::hasColumn('permission_requests', $column)) {
                    $table->dropColumn($column);
                }

            }
        });
    }
};