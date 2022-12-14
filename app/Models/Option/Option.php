<?php

namespace App\Models\Option;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'options';
    protected $primaryKey = 'id';
    protected $guarded = [];



    public function optionsTranslations()
    {
        return $this->hasMany('App\Models\Option\OptionTranslation','option_id','id');
    }


    public function optionsGroupsTranslations()
    {
        return $this->hasMany('App\Models\Option\OptionGroupTranslation','option_group_id','option_group_id');
    }

    public function optionsGroups()
    {
        return $this->hasMany('App\Models\Option\OptionGroup','id','option_group_id');
    }

}
