<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_number',
        'full_name',
        'email',
        'phone',
        'address',
        'cv_file',
        'status',
    ];
}