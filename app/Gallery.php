<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table='galleries';
    protected $fillable=['name','status','slug'];

    public function gallery_images()
    {
      return  $this->hasMany(GalleryImage::class,'gallery_id');
    }
}
