<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Menu extends Model
{
    use HasFactory, Sluggable, SluggableScopeHelpers;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'menu_title'
            ]
        ];
    }
    public function addedBy()
    {
        return $this->belongsTo(User::class,'addedby_id');
    }
    public function pages(){
		return $this->belongsToMany(Page::class, 'menu_pages', 'menu_id', 'page_id')->where('pages.active', true);
	}
    public function hasPage($page){
		$row = $this->pages()->where('pages.id',$page->id)->first();
		if($row){
			return true;
		}
		return false;
	}
}
