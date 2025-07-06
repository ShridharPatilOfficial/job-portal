<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubHistory extends Model
{
    use HasFactory;
    protected $table = 'sub_histories';
    protected $fillable = ['user_id', 'start_date', 'end_date', 'amount'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
