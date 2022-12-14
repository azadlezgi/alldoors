<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $table = 'posts_categories';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function postsCategoriesTranslations()
    {
        return $this->hasMany('App\Models\Post\PostCategoryTranslation','category_id','id');
    }


    public function getPostsCount()
    {
        return $this->hasMany('App\Models\Post\PostCategoryList','category_id','id');
    }

}
