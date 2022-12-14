<?php

namespace App\Models\Review;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $primaryKey = 'id';
    protected $guarded = [];



    public function reviewsTranslations()
    {
        return $this->hasMany('App\Models\Review\ReviewTranslation','review_id','id');
    }
}
