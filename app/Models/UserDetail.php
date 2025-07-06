<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
   use HasFactory;
   protected $table = 'user_details'; 

    protected $fillable = [
        'user_id', 'pref_location', 'pref_role', 'pref_sal_pack', 'job_type',
        'emp_type', 'total_experience', 'available_join', 'profile_summary',
        'skills', 'resume'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function educations() {
        return $this->hasMany(UserEducation::class);
    }
}
