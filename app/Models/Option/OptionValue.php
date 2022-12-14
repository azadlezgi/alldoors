<?php

namespace App\Models\Option;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    use HasFactory;

    protected $table = 'options_values';
    protected $primaryKey = 'id';
    protected $guarded = [];



    public function optionsValuesTranslations()
    {
        return $this->hasMany('App\Models\Option\OptionValueTranslation','option_value_id','id');
    }



}
