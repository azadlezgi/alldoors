<?php

namespace App\Models\Team;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';
    protected $primaryKey = 'id';
    protected $guarded = [];



    public function teamsTranslations()
    {
        return $this->hasMany('App\Models\Team\TeamTranslation','team_id','id');
    }
}
