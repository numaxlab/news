<?php

namespace NumaxLab\NewsPost\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;


class NewsPost extends Model
{
    use CrudTrait;
    use Sluggable;
    use HasTranslations;

    protected $table = 'news_posts';

    protected $fillable = [
        'title',
        'slug',
        'introduction',
        'content',
        'image_file_path',
        'is_public',
        'published_at',
        'caption',
    ];

    protected $translatable = [
        'title',
        'slug',
        'introduction',
        'content',
        'caption',
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title'],
            ]
        ];
    }

}
