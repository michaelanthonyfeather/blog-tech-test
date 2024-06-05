<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'published_at'
    ];

    public function casts()
    {
        return [
            'published_at' => 'datetime'
        ];
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_likes');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSummaryAttribute()
    {
        return substr($this->content, 0, 100);
    }

    public function getReadTimeAttribute()
    {
        return ceil(str_word_count($this->content) / 200);
    }
}
