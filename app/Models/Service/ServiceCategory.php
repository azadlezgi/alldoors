<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $table = 'services_categories';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function servicesCategoriesTranslations()
    {
        return $this->hasMany('App\Models\Service\ServiceCategoryTranslation','category_id','id');
    }


    public function getServicesCount()
    {
        return $this->hasMany('App\Models\Service\ServiceCategoryList','category_id','id');
    }

}
