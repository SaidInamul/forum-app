<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discussion extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug'
    ];

    protected static function booted() {
        static::created(function ($discussion) {
            $discussion->update(['slug' => $discussion->title]);
        });
    }

    public function setSlugAttribute ($value) {
        $this->attributes['slug'] = $this->id . '-' . Str::slug($value);
    }

    public function isPinned() {
        return !is_null($this->pinned_at);
    }

    public function scopeOrderByPinned ($query) {
        $query->orderBy('pinned_at', 'desc');
    }

    public function scopeOrderByLastPost ($query) {
        // grab the latest post by created_at
        // order the discussion based on that timeline
        $query->orderBy(
            Post::select('created_at')
            ->whereColumn('posts.discussion_id', 'discussions.id')
            ->latest()
            ->take(1),
            'desc'
        );
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function topic () {
        return $this->belongsTo(Topic::class);
    }

    public function posts () {
        return $this->hasMany(Post::class);
    }

    public function post () {
        return $this->hasOne(Post::class)
        ->whereNull('parent_id');
    }

    public function latestPost () {
        return $this->hasOne(Post::class)
        ->latestOfMany();
    }

    public function participants () {
        return $this->hasManyThrough(User::class, Post::class, 'discussion_id', 'id', 'id', 'user_id')
            ->distinct();
    }

    public function replies () {
        return $this->hasMany(Post::class)
            ->whereNotNull('parent_id');
    }
}
