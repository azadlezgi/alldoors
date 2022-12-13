<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function postsTranlations()
    {
        return $this->hasMany('App\Models\Post\PostTranslation','post_id','id');
    }

    public function postsCategories()
    {
        return $this->hasMany('App\Models\Post\PostCategoryList','post_id','id');
    }

    public function postsCategoriesCheck()
    {
        return $this->hasMany('App\Models\Post\PostCategoryList','post_id','id')
            ->join('posts_categories','posts_categories.id','=','posts_categories_lists.category_id')
            ->join('posts_categories_translations','posts_categories.id','=','posts_categories_translations.category_id')
            ->where('status',1)
            ->where('posts_categories_translations.language_id',cache('language-defaultID'));
    }


}
