<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Job extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'location',
        'type',
        'pdf_path',
    ];
    public function applications()
    {
        return $this->hasMany(\App\Models\JobApplication::class);
    }

    /**
     * Get the URL to the job's PDF details.
     *
     * @return string|null
     */
    public function getPdfUrlAttribute()
    {
        if ($this->pdf_path) {
            return Storage::url($this->pdf_path);
        }
        return null;
    }
}