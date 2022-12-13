<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategoryTranslation extends Model
{
    use HasFactory;

    protected $table = 'services_categories_translations';
    protected $guarded = [];

}
