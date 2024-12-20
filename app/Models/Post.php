<?php

namespace App\Models;

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
}
