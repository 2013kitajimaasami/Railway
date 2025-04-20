<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'address',
        'line',
        'toilet',
        'parking',
        'image',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // いいね用
    // public function followers() {
    //     return $this->belongsToMany(User::class);
    // }

    // public function likes() {
    //     return $this->hasMany(Like::class);
    // }

    public function likeds() {
        return $this->belongsToMany(User::class, 'likes');
    }

    // いいねされているかの判定
    // public function isLikedBy($user) {
    //     return Like::where('user_id', $user->id)->where('spot_id', $this->id)->first() !== null;
    // }

    

    


}
