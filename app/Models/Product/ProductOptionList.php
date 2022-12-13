<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptionList extends Model
{
    use HasFactory;

    protected $table = 'products_options_lists';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
