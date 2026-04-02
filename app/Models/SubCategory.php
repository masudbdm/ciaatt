<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Spatie\Translatable\HasTranslations as BaseHasTranslations;
use Spatie\Translatable\HasTranslations;

class SubCategory extends Model
{
    use HasFactory, Sluggable, SluggableScopeHelpers,HasTranslations,BaseHasTranslations;
    protected $translatable =['name'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function category()
    {
        $this->belongsTo(Category::class, 'category_id');
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_subcategories', 'subcategory_id', 'post_id');
    }

    public function hasPost($post)
    {
        $row = $this->posts()->where('posts.id', $post->id)->first();
        if ($row) {
            return true;
        }
        return false;
    }
}
