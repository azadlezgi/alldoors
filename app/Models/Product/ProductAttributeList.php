<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeList extends Model
{
    use HasFactory;

    protected $table = 'products_attributes_lists';
    protected $guarded = [];


}
