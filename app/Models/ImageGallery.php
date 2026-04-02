<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageGallery extends Model
{
    use HasFactory;
    public function items(){
        return $this->hasMany(ImageGalleryItem::class,'image_gallery_id');
    }
    public function fi()
    {
        if ($this->img_url) {
            return $this->img_url;
        } else {
            return 'img/fi.png';
        }
    }
    public function tempItemsDelete()
  {
  	$this->items()->where('publish_status','temp')->delete();
  }
}
