<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModelList extends Model
{
    use HasFactory;

    protected $table = 'products_models_lists';
    protected $primaryKey = 'id';
    protected $guarded = [];

}
