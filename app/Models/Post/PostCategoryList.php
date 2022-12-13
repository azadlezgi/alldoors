<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategoryList extends Model
{
    use HasFactory;

    protected $table = 'posts_categories_lists';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
