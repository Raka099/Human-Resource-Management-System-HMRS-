<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OvertimeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'overtime_date',
        'start_time',
        'end_time',
        'reason',
        'attachment',
        'status',
        'manager_note',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'overtime_date' => 'date',
            'approved_at' => 'datetime',
        ];
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}