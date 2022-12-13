<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function galleriesTranlations()
    {
        return $this->hasMany('App\Models\Gallery\GalleryTranslation','gallery_id','id');
    }

    public function galleriesCategories()
    {
        return $this->hasMany('App\Models\Gallery\GalleryCategoryList','gallery_id','id');
    }

    public function galleriesCategoriesCheck()
    {
        return $this->hasMany('App\Models\Gallery\GalleryCategoryList','gallery_id','id')
            ->join('galleries_categories','galleries_categories.id','=','galleries_categories_lists.category_id')
            ->join('galleries_categories_translations','galleries_categories.id','=','galleries_categories_translations.category_id')
            ->where('status',1)
            ->where('galleries_categories_translations.language_id',cache('language-defaultID'));
    }


}
