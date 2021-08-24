<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class profile extends Model
{
    use HasFactory;

    protected $fillable=['user_id', 'facebook', 'youtube', 'avatar', 'about'];
    public function user(){

        return $this->belongsTo('App\Models\User');
    }


    public function getFeaturedAttribute($avatar)
    {
        return asset($avatar);
    }
}
