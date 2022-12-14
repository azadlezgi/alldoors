<?php

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';
    protected $primaryKey = 'id';
    protected $guarded = [];



    public function attributesTranslations()
    {
        return $this->hasMany('App\Models\Attribute\AttributeTranslation','attribute_id','id');
    }


    public function attributesGroupsTranslations()
    {
        return $this->hasMany('App\Models\Attribute\AttributeGroupTranslation','attribute_group_id','attribute_group_id');
    }

    public function attributesGroups()
    {
        return $this->hasMany('App\Models\Attribute\AttributeGroup','id','attribute_group_id');
    }

}
