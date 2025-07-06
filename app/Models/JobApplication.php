<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
   use HasFactory;
    protected $table = 'job_applications';
    protected $fillable = ['job_id', 'user_id', 'resume_url', 'status'];

    public function job() {
        return $this->belongsTo(Job::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
