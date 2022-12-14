<?php

namespace App\Models\Slide;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'slides';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function slidesTranslations()
    {
        return $this->hasMany('App\Models\Slide\SlideTranslation','slide_id','id');
    }

}
