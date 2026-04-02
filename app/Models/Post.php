<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Spatie\Translatable\HasTranslations as BaseHasTranslations;
use Spatie\Translatable\HasTranslations;
use App\Models\PostCategory;

class Post extends Model
{
	use HasFactory, Sluggable, SluggableScopeHelpers,HasTranslations,BaseHasTranslations;
    public $translatable = ['title','description','excerpt','tags'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $fillable= ['post_id','category_id'];

    public function fi()
    {
        if($this->feature_img_name){
            return $this->feature_img_name;
        }else{
            return "logo_name.jpg";
        }
    }
    public function writer()
    {
        return $this->belongsTo(User::class,'writer_id');
    }
    public function categories()
	{
		return $this->belongsToMany(Category::class, 'post_categories', 'post_id','category_id',);
	}

	public function subcategories()
	{
		return $this->belongsToMany(SubCategory::class, 'post_subcategories', 'post_id', 'subcategory_id');
	}
    public function toArray()
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, \App::getLocale());
        }
        return $attributes;
    }

    public function user()
    {
        return $this->belongsTo(User::class,'addedby_id');
    }

    // public function ima(Type $var = null)
    // {
    //     # code...
    // }
}
