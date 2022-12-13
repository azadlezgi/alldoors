<?php

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeGroupTranslation extends Model
{
    use HasFactory;

    protected $table = 'attributes_groups_translations';
    protected $guarded = [];

}
