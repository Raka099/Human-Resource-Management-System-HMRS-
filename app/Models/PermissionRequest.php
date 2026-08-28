<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PermissionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'permission_type',
        'start_date',
        'end_date',
        'reason',
        'attachment',
        'status',
        'manager_note',
        'approved_at',
        'manager_status',
        'manager_note',
        'manager_approved_at',

        'hr_status',
        'hr_note',
        'hr_approved_at',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'approved_at' => 'datetime',
        ];
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}