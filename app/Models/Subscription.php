<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
     use HasFactory;
     protected $table = 'subscriptions';

    protected $fillable = ['user_id', 'amount', 'status', 'active_count'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
