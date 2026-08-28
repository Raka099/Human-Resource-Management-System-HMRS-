<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Leave Requests
        |--------------------------------------------------------------------------
        */

        Schema::table('leave_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('leave_requests', 'hr_status')) {
                $table->string('hr_status')
                    ->default('Pending')
                    ->after('manager_status');
            }

            if (!Schema::hasColumn('leave_requests', 'hr_note')) {
                $table->text('hr_note')
                    ->nullable()
                    ->after('hr_status');
            }

            if (!Schema::hasColumn('leave_requests', 'hr_approved_at')) {
                $table->timestamp('hr_approved_at')
                    ->nullable()
                    ->after('hr_note');
            }
        });


        /*
        |--------------------------------------------------------------------------
        | Permission Requests
        |--------------------------------------------------------------------------
        */

        Schema::table('permission_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('permission_requests', 'hr_status')) {
                $table->string('hr_status')
                    ->default('Pending')
                    ->after('manager_status');
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


        /*
        |--------------------------------------------------------------------------
        | Overtime Requests
        |--------------------------------------------------------------------------
        */

        Schema::table('overtime_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('overtime_requests', 'hr_status')) {
                $table->string('hr_status')
                    ->default('Pending')
                    ->after('manager_status');
            }

            if (!Schema::hasColumn('overtime_requests', 'hr_note')) {
                $table->text('hr_note')
                    ->nullable()
                    ->after('hr_status');
            }

            if (!Schema::hasColumn('overtime_requests', 'hr_approved_at')) {
                $table->timestamp('hr_approved_at')
                    ->nullable()
                    ->after('hr_note');
            }
        });
    }


    public function down(): void
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            $table->dropColumn([
                'hr_status',
                'hr_note',
                'hr_approved_at'
            ]);
        });

        Schema::table('permission_requests', function (Blueprint $table) {
            $table->dropColumn([
                'hr_status',
                'hr_note',
                'hr_approved_at'
            ]);
        });

        Schema::table('overtime_requests', function (Blueprint $table) {
            $table->dropColumn([
                'hr_status',
                'hr_note',
                'hr_approved_at'
            ]);
        });
    }
};