<?php

namespace App\Models\Option;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    use HasFactory;

    protected $table = 'options_groups';
    protected $primaryKey = 'id';
    protected $guarded = [];



    public function optionsGroupsTranslations()
    {
        return $this->hasMany('App\Models\Option\OptionGroupTranslation','option_group_id','id');
    }

    public function getOptionsCount()
    {
        return $this->hasMany('App\Models\Option\Option','option_group_id','id');
    }

    public function options()
    {
        return $this->hasMany(Option::class,'option_group_id');
    }


    public function optionsTranslations()
    {
        return $this->hasMany('App\Models\Option\OptionTranslation','option_id','id');
    }




}
