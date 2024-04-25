<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'job_id',
        'action',
        'remarks',
        'status',
    ];
}
