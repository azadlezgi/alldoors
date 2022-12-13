<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductManufacturerList extends Model
{
    use HasFactory;

    protected $table = 'products_manufacturers_lists';
    protected $primaryKey = 'id';
    protected $guarded = [];

}
