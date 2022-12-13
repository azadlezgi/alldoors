<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $table = 'galleries_categories';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function galleriesCategoriesTranlations()
    {
        return $this->hasMany('App\Models\Gallery\GalleryCategoryTranslation','category_id','id');
    }


    public function getGalleriesCount()
    {
        return $this->hasMany('App\Models\Gallery\GalleryCategoryList','category_id','id');
    }

}
