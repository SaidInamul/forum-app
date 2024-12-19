<?php

namespace App\Models;

use App\Models\User;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discussion extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'topic_id',
        'user_id',
        'pinned_at',
    ];

    public function isPinned() {
        return !is_null($this->pinned_at);
    }

    public function scopeOrderByPinned ($query) {
        $query->orderBy('pinned_at', 'desc');
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function topic () {
        return $this->belongsTo(Topic::class);
    }
}
