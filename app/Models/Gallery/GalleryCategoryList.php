<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategoryList extends Model
{
    use HasFactory;

    protected $table = 'galleries_categories_lists';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
