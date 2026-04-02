<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations as BaseHasTranslations;
use Spatie\Translatable\HasTranslations;
class Category extends Model
{
    use HasFactory, HasTranslations,BaseHasTranslations;
    protected $fillable= ['name'];
    protected $translatable =['name'];

    // public function image()
    // {
    //     if($this->latestPost()->feature_img_name)
    //     {
    //         return $this->feature_img_name;
    //     }
    //     else{
    //         return 'logo_name.jpg';

    //     }
    // }
    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'name'
    //         ]
    //     ];
    // }

    public function subcats()
    {
       return $this->hasMany(SubCategory::class, 'category_id')->orderBy('name');
    }
    public function posts(){
		return $this->belongsToMany(Post::class, 'post_categories', 'category_id', 'post_id');
	}

    // Azbi
    public function latestPost(){
		return $this->posts()->first();
	}

	public function hasPost($post){
		$row = $this->posts()->where('posts.id',$post->id)->first();
		if($row){
			return true;
		}
		return false;
	}
    // public function toArray()
    // {
    //     $attributes = parent::toArray();
    //     foreach ($this->getTranslatableAttributes() as $field) {
    //         $attributes[$field] = $this->getTranslation($field, \App::getLocale());
    //     }
    //     return $attributes;
    // }

    public function postCategory()
    {
        return $this->hasMany(PostCategory::class, 'category_id');
    }

    public function postCat()
    {
        // return $this->postCategory()->where('category_id',$this->id)->first()->pluck('post_id');
        return $this->postCategory()->where('category_id',$this->id)->first();
    }

    
}
