<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'user_id',
    ];
    public function job()
    {
        return $this->belongsTo(\App\Models\Job::class);
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}