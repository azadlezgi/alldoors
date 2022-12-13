<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryList extends Model
{
    use HasFactory;

    protected $table = 'products_categories_lists';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
