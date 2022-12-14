<?php

namespace App\Models\Banner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function bannersTranslations()
    {
        return $this->hasMany('App\Models\Banner\BannerTranslation','banner_id','id');
    }

}
