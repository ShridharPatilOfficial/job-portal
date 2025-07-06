<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
     use HasFactory;
    protected $table = 'user_experiences'; 
   protected $fillable = [
        'user_id', 'current_company', 'company_name', 'industry', 'job_role',
        'job_type', 'employment_type', 'start_date', 'end_date', 'skills_used', 'job_profile'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
