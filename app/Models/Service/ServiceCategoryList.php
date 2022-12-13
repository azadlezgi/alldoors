<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategoryList extends Model
{
    use HasFactory;

    protected $table = 'services_categories_lists';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
