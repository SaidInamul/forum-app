<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\Discussion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    public function discussion () {
        return $this->belongsTo(Discussion::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function parent () {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function mentions () {
        return $this->belongsToMany(User::class, 'mentions', 'post_id')->withTimestamps();
    }
}
