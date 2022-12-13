<?php

namespace App\Models\Option;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionGroupTranslation extends Model
{
    use HasFactory;

    protected $table = 'options_groups_translations';
    protected $guarded = [];

}
