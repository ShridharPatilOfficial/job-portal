<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    use HasFactory;
    protected $table = 'user_educations'; 

    protected $fillable = [
        'user_id', 'user_detail_id', 'degree', 'institute_name', 'specialization',
        'course_type', 'start_month', 'start_year', 'end_month', 'end_year',
        'grade_cgpa', 'grade_per'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function userDetail() {
        return $this->belongsTo(UserDetail::class);
    }
}
