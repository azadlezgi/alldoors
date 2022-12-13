<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategoryTranslation extends Model
{
    use HasFactory;

    protected $table = 'posts_categories_translations';
    protected $guarded = [];

}
