<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
      use HasFactory;
    protected $table = 'job_categories';
    protected $fillable = ['name', 'type'];

    public function jobs() {
        return $this->hasMany(Job::class, 'category_id');
    }
}
