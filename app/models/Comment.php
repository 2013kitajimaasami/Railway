<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body',
        'spot_id',
        'user_id',
    ];

    public function spot() {
        return $this->belongsTo(Spot::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
