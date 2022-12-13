<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCollectionTranslation extends Model
{
    use HasFactory;

    protected $table = 'products_collections_translations';
    protected $guarded = [];
}
