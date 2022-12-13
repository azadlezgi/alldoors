<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModelTranslation extends Model
{
    use HasFactory;

    protected $table = 'products_models_translations';
    protected $guarded = [];
}
