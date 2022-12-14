<?php

namespace App\Models\OnlineCatalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineCatalog extends Model
{
    use HasFactory;

    protected $table = 'online_catalogs';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function onlineCatalogsTranslations()
    {
        return $this->hasMany('App\Models\OnlineCatalog\OnlineCatalogTranslation','online_catalog_id','id');
    }

}
