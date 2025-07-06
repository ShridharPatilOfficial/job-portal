<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
     use HasFactory;
protected $table = 'jobs';
    protected $fillable = [
        'company_id', 'category_id', 'title', 'vacancies', 'location', 'role',
        'min_ex', 'max_ex', 'employment_type', 'min_sal', 'max_sal',
        'required_skills', 'semi_required_skills', 'description',
        'job_status', 'status', 'last_date_apply'
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function category() {
        return $this->belongsTo(JobCategory::class);
    }

    public function applications() {
        return $this->hasMany(JobApplication::class);
    }
}