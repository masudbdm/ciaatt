<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Page extends Model
{
    use HasFactory, Sluggable, SluggableScopeHelpers;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'page_title'
            ]
        ];
    }
    public function items()
    {
    	return $this->hasMany(PageItem::class, 'page_id');
    }

    public function menus()
	{
		return $this->belongsToMany(Menu::class, 'menu_pages', 'page_id', 'menu_id');
	}
}
