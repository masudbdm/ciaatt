<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageGalleryItem extends Model
{
    use HasFactory;
    public function fi()
    {
        if ($this->img_url) {
            return $this->img_url;
        } else {
            return 'img/fi.png';
        }
    }
}
