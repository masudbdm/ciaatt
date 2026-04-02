<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteParameter extends Model
{
    use HasFactory;
    public function getEditions()
    {
       return explode(',',$this->news_editions);
    }

    public function logo()
    {
       return $this->logo ? 'storage/logo/'.$this->logo : 'logo.png';
    }

    public function logoAlt()
    {
       return $this->logo_alt ? 'storage/logo/'.$this->logo_alt : 'logo.png';
    }

    public function favIcon()
    {
       return $this->favicon ? 'storage/favicon/'.$this->favicon : 'favicon.png';
    }

    public function featuredImage()
    {
       return $this->featured_image ? 'storage/featured/'.$this->featured_image : 'logo.png';
    }

    public function featuredVideo()
    {
       return $this->featured_video ? 'storage/featured-video/'.$this->featured_video : null;
    }
}
