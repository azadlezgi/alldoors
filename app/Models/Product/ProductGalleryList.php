<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGalleryList extends Model
{
    use HasFactory;

    protected $table = 'products_galleries_lists';
    protected $primaryKey = 'id';
    protected $guarded = [];

}
