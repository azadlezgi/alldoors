<?php

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    use HasFactory;

    protected $table = 'attributes_groups';
    protected $primaryKey = 'id';
    protected $guarded = [];



    public function attributesGroupsTranslations()
    {
        return $this->hasMany('App\Models\Attribute\AttributeGroupTranslation','attribute_group_id','id');
    }

    public function getAttributesCount()
    {
        return $this->hasMany('App\Models\Attribute\Attribute','attribute_group_id','id');
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class,'attribute_group_id');
    }


    public function attributesTranslations()
    {
        return $this->hasMany('App\Models\Attribute\AttributeTranslation','attribute_id','id');
    }




}
