<?php

namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerTranslation extends Model
{
    use HasFactory;

    protected $table = 'partners_translations';
    protected $guarded = [];
}
