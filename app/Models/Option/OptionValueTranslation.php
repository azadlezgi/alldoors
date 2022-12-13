<?php

namespace App\Models\Option;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValueTranslation extends Model
{
    use HasFactory;

    protected $table = 'options_values_translations';
    protected $guarded = [];

}
