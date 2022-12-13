<?php

namespace App\Models\Review;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewTranslation extends Model
{
    use HasFactory;

    protected $table = 'reviews_translations';
    protected $guarded = [];
}
