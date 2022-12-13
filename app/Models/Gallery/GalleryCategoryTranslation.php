<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategoryTranslation extends Model
{
    use HasFactory;

    protected $table = 'galleries_categories_translations';
    protected $guarded = [];

}
