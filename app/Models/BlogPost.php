<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'blog_category_id',
        'title',
        'slug',
        'author',
        'photo',
        'published_at',
        'tags',
        'content',
        'status',
        'is_editors_choice',
        'views'
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_editors_choice' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function images()
    {
        return $this->hasMany(BlogPostImage::class)->orderBy('sort_order');
    }
}
