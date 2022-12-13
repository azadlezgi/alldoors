<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpecialPriceList extends Model
{
    use HasFactory;

    protected $table = 'products_specials_prices_lists';
    protected $guarded = [];


}
