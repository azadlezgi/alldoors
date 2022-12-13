<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCollectionList extends Model
{
    use HasFactory;

    protected $table = 'products_collections_lists';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
