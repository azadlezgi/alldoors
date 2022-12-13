<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductManufacturerTranslation extends Model
{
    use HasFactory;

    protected $table = 'products_manufacturers_translations';
    protected $guarded = [];

}
