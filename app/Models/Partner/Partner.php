<?php

namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $table = 'partners';
    protected $primaryKey = 'id';
    protected $guarded = [];



    public function partnersTranslations()
    {
        return $this->hasMany('App\Models\Partner\PartnerTranslation','partner_id','id');
    }
}
