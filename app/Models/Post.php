<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tag;
class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $date = ['deleted_at'];
    public function getFeaturedAttribute($featured)
    {
        return asset($featured);  
    }

    protected $fillable = [
        'content', 'title', 'category_id', 'featured', 'slug'
    ];
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    
}
