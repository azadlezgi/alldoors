<?php


use Illuminate\Support\Facades\Route;

/**
 * FAYL MANAGER UCUN CONNECTOR
 * /ckfinder/connector bu yolu deyishme ishlemeyecek ckfinder fayl yuklmeleri ve s.
 */
Route::middleware(['auth', 'StatususerCheck', 'Common', 'CustomCKFinderAuth', 'FileManager'])->group(function () {
    Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
        ->name('ckfinder_connector');
});


/* BACKEND START  */
Route::namespace('Admin')->group(function () {
    Route::prefix(env('APP_PANEL_NAME'))->middleware(['auth', 'StatususerCheck', 'Common'])->group(function () {

        Route::get('test',function (){
            $test = \Illuminate\Support\Str::random(10);
           @dd($test);
        });


        /*   Admin Dashboard   */
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::get('/permission', 'AdminController@permission')->name('admin.permission');

        /*   Language START  */
        Route::namespace('Language')->group(function () {

            /*   Language   */
            Route::prefix('language')->group(function () {
                Route::get('/', 'LanguageController@index')->name('admin.language.index');
                Route::post('/add', 'LanguageController@add')->name('admin.language.add');
                Route::post('/update', 'LanguageController@update')->name('admin.language.update');
                Route::post('/delete', 'LanguageController@delete')->name('admin.language.delete');
                Route::post('/delete-ajax', 'LanguageController@deleteAjax')->name('admin.language.deleteAjax');
                Route::post('/all-delete-ajax', 'LanguageController@allDeleteAjax')->name('admin.language.allDeleteAjax');
                Route::post('/edit-ajax', 'LanguageController@editAjax')->name('admin.language.editAjax');
                Route::post('/default-status', 'LanguageController@defaultStatus')->name('admin.language.defaultStatus');
                Route::post('/sort-ajax', 'LanguageController@sortAjax')->name('admin.language.sortAjax');
                Route::post('/status-ajax', 'LanguageController@statusAjax')->name('admin.language.statusAjax');
                Route::get('/search/{text?}', 'LanguageController@search')->name('admin.language.search');
            });

            /*   Language GROUPS   */
            Route::prefix('language-group')->group(function () {
                Route::get('/', 'LanguageGroupController@index')->name('admin.languageGroup.index');
                Route::post('/add', 'LanguageGroupController@groupAdd')->name('admin.languageGroup.add');
                Route::post('/update', 'LanguageGroupController@groupUpdate')->name('admin.languageGroup.update');
                Route::post('/delete', 'LanguageGroupController@groupDelete')->name('admin.languageGroup.delete');
                Route::post('/delete-ajax', 'LanguageGroupController@deleteAjax')->name('admin.languageGroup.deleteAjax');
                Route::post('/all-delete-ajax', 'LanguageGroupController@allDeleteAjax')->name('admin.languageGroup.allDeleteAjax');
                Route::post('/all-delete', 'LanguageGroupController@allDelete')->name('admin.languageGroup.allDelete');
                Route::post('/edit-ajax', 'LanguageGroupController@groupEditAjax')->name('admin.languageGroup.editAjax');
                Route::get('/search/{text?}', 'LanguageGroupController@groupSearch')->name('admin.languageGroup.search');
                /*   Language Group Detail   */
                Route::get('/detail/{id}', 'LanguageGroupController@groupDetail')->where('id', '[0-9]+')->name('admin.languageGroup.detail');
                Route::post('/detail-phrase-add', 'LanguageGroupController@groupDetailPhraseAdd')->name('admin.languageGroup.phraseAdd');
                Route::post('/detail-phrase-edit-ajax', 'LanguageGroupController@groupDetailPhraseEditAjax')->name('admin.languageGroup.phraseEditAjax');
                Route::post('/detail-phrase-update', 'LanguageGroupController@groupDetailPhraseUpdate')->name('admin.languageGroup.phraseUpdate');
                Route::get('/detail/search/{id?}/{text?}', 'LanguageGroupController@groupDetailSearch')->name('admin.languageGroup.groupDetailSearch');
                Route::post('/detail/delete', 'LanguageGroupController@groupDetailDelete')->name('admin.languageGroup.groupDetailDelete');
                Route::post('/detail/delete-ajax', 'LanguageGroupController@groupDetailDeleteAjax')->name('admin.languageGroup.groupDetailDeleteAjax');
            });


            /*   Language Phrase   */
            Route::prefix('language-phrase')->group(function () {
                Route::get('/', 'LanguagePhraseController@index')->name('admin.languagePhrase.index');
                Route::post('/phrase-add', 'LanguagePhraseController@add')->name('admin.languagePhrase.add');
                Route::post('/phrase-edit-ajax', 'LanguagePhraseController@editAjax')->name('admin.languagePhrase.editAjax');
                Route::post('/phrase-update', 'LanguagePhrasneController@update')->name('admin.languagePhrase.update');
                Route::get('/search/{text?}', 'LanguagePhraseController@search')->name('admin.languagePhrase.search');
                Route::post('/delete', 'LanguagePhraseController@delete')->name('admin.languagePhrase.delete');
                Route::post('/delete-ajax', 'LanguagePhraseController@deleteAjax')->name('admin.languagePhrase.deleteAjax');
                Route::post('/all-delete-ajax', 'LanguagePhraseController@allDeleteAjax')->name('admin.languagePhrase.allDeleteAjax');
            });

        });
        /*   Language END  */


        /*   MENU START   */
        Route::namespace('Menu')->group(function () {
            Route::prefix('menu')->group(function () {
                Route::get('/', 'MenuController@index')->name('admin.menu.index');
                Route::get('/add', 'MenuController@add')->name('admin.menu.add');
                Route::post('/add-menu-name', 'MenuController@addMenuName')->name('admin.menu.addMenuName');
                Route::post('/delete', 'MenuController@delete')->name('admin.menu.delete');
                Route::get('/edit/{id}', 'MenuController@edit')->name('admin.menu.edit');
                Route::post('/position-add', 'MenuController@positionAdd')->name('admin.menu.positionAdd');
                Route::post('/position-delete-ajax', 'MenuController@positionDeletAjax')->name('admin.menu.position.delete.ajax');
                Route::post('/all-delete-ajax', 'MenuController@allDeleteAjax')->name('admin.menu.allDeleteAjax');
                Route::post('/all-delete', 'MenuController@allDelete')->name('admin.menu.allDelete');
                Route::post('/edit-ajax', 'MenuController@editAjax')->name('admin.menu.edit.ajax');
                Route::post('/store-ajax', 'MenuController@storeAjax')->name('admin.menu.store.ajax');
                Route::post('/change-ajax', 'MenuController@changeAjax')->name('admin.menu.change.ajax');
                Route::post('/delete-ajax', 'MenuController@deleteAjax')->name('admin.menu.delete.ajax');

            });
        });
        /*   MENU END   */


        /*   USERS START   */
        Route::namespace('User')->group(function () {
            Route::prefix('user')->group(function () {
                Route::get('/', 'UserController@index')->name('admin.user.index');
                Route::get('/add', 'UserController@add')->name('admin.user.add');
                Route::post('/store', 'UserController@store')->name('admin.user.store');
                Route::get('/edit/{id}', 'UserController@edit')->name('admin.user.edit');
                Route::post('/update', 'UserController@update')->name('admin.user.update');
                Route::get('/search', 'UserController@search')->name('admin.users.search');
                Route::get('/status-ajax', 'UserController@statusAjax');
                Route::post('/status-ajax', 'UserController@statusAjax')->name('admin.user.statusAjax');
                Route::post('/delete-ajax', 'UserController@deleteAjax')->name('admin.user.deleteAjax');
                Route::post('/delete', 'UserController@delete')->name('admin.user.delete');
                Route::post('/all-delete-ajax', 'UserController@allDeleteAjax')->name('admin.user.allDeleteAjax');

            });

            Route::prefix('profil')->group(function () {
                Route::get('/edit/{id}', 'UserController@profilEdit')->name('admin.user.profilEdit');
                Route::post('/profilUpdate', 'UserController@profilUpdate')->name('admin.user.profilUpdate');
            });

        });
        /*   USERS END   */


        /*   SETTINGS START   */
        Route::namespace('Setting')->group(function () {
            Route::prefix('setting')->group(function () {
                Route::get('/', 'SettingController@index')->name('admin.setting.index');
                Route::post('/update', 'SettingController@update')->name('admin.setting.update');
                Route::post('/search-icons', 'SettingController@searchIcons')->name('admin.setting.searchIcons');

            });
        });
        /*   SETTINGS END   */


        /*   SLIDE START   */
        Route::namespace('Slide')->group(function () {
            Route::prefix('slide')->group(function () {
                Route::get('/', 'SlideController@index')->name('admin.slide.index');
                Route::get('/add', 'SlideController@add')->name('admin.slide.add');
                Route::post('/store', 'SlideController@store')->name('admin.slide.store');
                Route::get('/edit/{id}', 'SlideController@edit')->name('admin.slide.edit');
                Route::post('/update', 'SlideController@update')->name('admin.slide.update');
                Route::post('/sort-ajax', 'SlideController@sortAjax')->name('admin.slide.sortAjax');
                Route::post('/status-ajax', 'SlideController@statusAjax')->name('admin.slide.statusAjax');
                Route::post('/delete', 'SlideController@delete')->name('admin.slide.delete');
                Route::post('/delete-ajax', 'SlideController@deleteAjax')->name('admin.slide.deleteAjax');
                Route::post('/all-delete-ajax', 'SlideController@allDeleteAjax')->name('admin.slide.allDeleteAjax');

            });
        });
        /*   SLIDE END   */


        /*   Online Catalog START   */
        Route::namespace('OnlineCatalog')->group(function () {
            Route::prefix('onlineCatalog')->group(function () {
                Route::get('/', 'OnlineCatalogController@index')->name('admin.onlineCatalog.index');
                Route::get('/add', 'OnlineCatalogController@add')->name('admin.onlineCatalog.add');
                Route::post('/store', 'OnlineCatalogController@store')->name('admin.onlineCatalog.store');
                Route::get('/edit/{id}', 'OnlineCatalogController@edit')->name('admin.onlineCatalog.edit');
                Route::post('/update', 'OnlineCatalogController@update')->name('admin.onlineCatalog.update');
                Route::post('/sort-ajax', 'OnlineCatalogController@sortAjax')->name('admin.onlineCatalog.sortAjax');
                Route::post('/status-ajax', 'OnlineCatalogController@statusAjax')->name('admin.onlineCatalog.statusAjax');
                Route::post('/delete', 'OnlineCatalogController@delete')->name('admin.onlineCatalog.delete');
                Route::post('/delete-ajax', 'OnlineCatalogController@deleteAjax')->name('admin.onlineCatalog.deleteAjax');
                Route::post('/all-delete-ajax', 'OnlineCatalogController@allDeleteAjax')->name('admin.onlineCatalog.allDeleteAjax');

            });
        });
        /*   Online Catalog END   */



        /*   BANNER START   */
        Route::namespace('Banner')->group(function () {
            Route::prefix('banner')->group(function () {
                Route::get('/', 'BannerController@index')->name('admin.banner.index');
                Route::get('/add', 'BannerController@add')->name('admin.banner.add');
                Route::post('/store', 'BannerController@store')->name('admin.banner.store');
                Route::get('/edit/{id}', 'BannerController@edit')->name('admin.banner.edit');
                Route::post('/update', 'BannerController@update')->name('admin.banner.update');
                Route::post('/sort-ajax', 'BannerController@sortAjax')->name('admin.banner.sortAjax');
                Route::post('/status-ajax', 'BannerController@statusAjax')->name('admin.banner.statusAjax');
                Route::post('/delete', 'BannerController@delete')->name('admin.banner.delete');
                Route::post('/delete-ajax', 'BannerController@deleteAjax')->name('admin.banner.deleteAjax');
                Route::post('/all-delete-ajax', 'BannerController@allDeleteAjax')->name('admin.banner.allDeleteAjax');

            });
        });
        /*   BANNER END   */




        /*   PARTNER START   */
        Route::namespace('Partner')->group(function () {
            Route::prefix('partner')->group(function () {
                Route::get('/', 'PartnersController@index')->name('admin.partner.index');
                Route::get('/add', 'PartnersController@add')->name('admin.partner.add');
                Route::post('/store', 'PartnersController@store')->name('admin.partner.store');
                Route::get('/edit/{id}', 'PartnersController@edit')->name('admin.partner.edit');
                Route::post('/update', 'PartnersController@update')->name('admin.partner.update');
                Route::post('/sort-ajax', 'PartnersController@sortAjax')->name('admin.partner.sortAjax');
                Route::post('/status-ajax', 'PartnersController@statusAjax')->name('admin.partner.statusAjax');
                Route::post('/delete', 'PartnersController@delete')->name('admin.partner.delete');
                Route::post('/delete-ajax', 'PartnersController@deleteAjax')->name('admin.partner.deleteAjax');
                Route::post('/all-delete-ajax', 'PartnersController@allDeleteAjax')->name('admin.partner.allDeleteAjax');

            });
        });
        /*   PARTNER END   */



        /*   REVIEW START   */
        Route::namespace('Review')->group(function () {
            Route::prefix('review')->group(function () {
                Route::get('/', 'ReviewsController@index')->name('admin.review.index');
                Route::get('/add', 'ReviewsController@add')->name('admin.review.add');
                Route::post('/store', 'ReviewsController@store')->name('admin.review.store');
                Route::get('/edit/{id}', 'ReviewsController@edit')->name('admin.review.edit');
                Route::post('/update', 'ReviewsController@update')->name('admin.review.update');
                Route::post('/sort-ajax', 'ReviewsController@sortAjax')->name('admin.review.sortAjax');
                Route::post('/status-ajax', 'ReviewsController@statusAjax')->name('admin.review.statusAjax');
                Route::post('/delete', 'ReviewsController@delete')->name('admin.review.delete');
                Route::post('/delete-ajax', 'ReviewsController@deleteAjax')->name('admin.review.deleteAjax');
                Route::post('/all-delete-ajax', 'ReviewsController@allDeleteAjax')->name('admin.review.allDeleteAjax');

            });
        });
        /*   REVIEW END   */




        /*   TEAM START   */
        Route::namespace('Team')->group(function () {
            Route::prefix('team')->group(function () {
                Route::get('/', 'TeamsController@index')->name('admin.team.index');
                Route::get('/add', 'TeamsController@add')->name('admin.team.add');
                Route::post('/store', 'TeamsController@store')->name('admin.team.store');
                Route::get('/edit/{id}', 'TeamsController@edit')->name('admin.team.edit');
                Route::post('/update', 'TeamsController@update')->name('admin.team.update');
                Route::post('/sort-ajax', 'TeamsController@sortAjax')->name('admin.team.sortAjax');
                Route::post('/status-ajax', 'TeamsController@statusAjax')->name('admin.team.statusAjax');
                Route::post('/delete', 'TeamsController@delete')->name('admin.team.delete');
                Route::post('/delete-ajax', 'TeamsController@deleteAjax')->name('admin.team.deleteAjax');
                Route::post('/all-delete-ajax', 'TeamsController@allDeleteAjax')->name('admin.team.allDeleteAjax');

            });
        });
        /*   TEAM END   */



        /*   PAGES START   */
        Route::namespace('Page')->group(function () {
            Route::prefix('page')->group(function () {
                Route::get('/', 'PageController@index')->name('admin.page.index');
                Route::get('/add', 'PageController@add')->name('admin.page.add');
                Route::post('/store', 'PageController@store')->name('admin.page.store');
                Route::get('/edit/{id}', 'PageController@edit')->name('admin.page.edit');
                Route::post('/update', 'PageController@update')->name('admin.page.update');
                Route::post('/slug', 'PageController@slug')->name('admin.page.slug');
                Route::post('/status-ajax', 'PageController@statusAjax')->name('admin.page.statusAjax');
                Route::post('/delete', 'PageController@delete')->name('admin.page.delete');
                Route::post('/delete-ajax', 'PageController@deleteAjax')->name('admin.page.deleteAjax');
                Route::post('/all-delete-ajax', 'PageController@allDeleteAjax')->name('admin.page.allDeleteAjax');
                Route::get('/search', 'PageController@search')->name('admin.page.search');

            });
        });
        /*   PAGES END   */



        /*   POST START   */
        Route::namespace('Post')->group(function () {
            Route::prefix('post')->group(function () {
                Route::get('/', 'PostController@index')->name('admin.post.index');
                Route::get('/add', 'PostController@add')->name('admin.post.add');
                Route::post('/store', 'PostController@store')->name('admin.post.store');
                Route::get('/edit/{id}', 'PostController@edit')->name('admin.post.edit');
                Route::post('/update', 'PostController@update')->name('admin.post.update');
                Route::post('/slug', 'PostController@slug')->name('admin.post.slug');
                Route::post('/status-ajax', 'PostController@statusAjax')->name('admin.post.statusAjax');
                Route::post('/delete', 'PostController@delete')->name('admin.post.delete');
                Route::post('/delete-ajax', 'PostController@deleteAjax')->name('admin.post.deleteAjax');
                Route::post('/all-delete-ajax', 'PostController@allDeleteAjax')->name('admin.post.allDeleteAjax');
                Route::get('/search', 'PostController@search')->name('admin.post.search');
                Route::get('/categories/{id}', 'PostController@categories')->name('admin.post.categories');

            });
        });
        /*   POST END   */



        /*   POST CATEGORY START   */
//        Route::namespace('Post')->group(function () {
//            Route::prefix('post/category/')->group(function () {
//                Route::get('/', 'PostCategoryController@index')->name('admin.post.category.index');
//                Route::get('/add', 'PostCategoryController@add')->name('admin.post.category.add');
//                Route::post('/store', 'PostCategoryController@store')->name('admin.post.category.store');
//                Route::get('/edit/{id}', 'PostCategoryController@edit')->name('admin.post.category.edit');
//                Route::post('/update', 'PostCategoryController@update')->name('admin.post.category.update');
//                Route::post('/slug', 'PostCategoryController@slug')->name('admin.post.category.slug');
//                Route::post('/status-ajax', 'PostCategoryController@statusAjax')->name('admin.post.category.statusAjax');
//                Route::post('/delete', 'PostCategoryController@delete')->name('admin.post.category.delete');
//                Route::post('/delete-ajax', 'PostCategoryController@deleteAjax')->name('admin.post.category.deleteAjax');
//                Route::post('/all-delete-ajax', 'PostCategoryController@allDeleteAjax')->name('admin.post.category.allDeleteAjax');
//                Route::get('/search', 'PostCategoryController@search')->name('admin.post.category.search');
//
//            });
//        });
        /*   POST CATEGORY END   */



        /*   GALLERY START   */
        Route::namespace('Gallery')->group(function () {
            Route::prefix('gallery')->group(function () {
                Route::get('/', 'GalleryController@index')->name('admin.gallery.index');
                Route::get('/add', 'GalleryController@add')->name('admin.gallery.add');
                Route::post('/store', 'GalleryController@store')->name('admin.gallery.store');
                Route::get('/edit/{id}', 'GalleryController@edit')->name('admin.gallery.edit');
                Route::post('/update', 'GalleryController@update')->name('admin.gallery.update');
                Route::post('/slug', 'GalleryController@slug')->name('admin.gallery.slug');
                Route::post('/status-ajax', 'GalleryController@statusAjax')->name('admin.gallery.statusAjax');
                Route::post('/delete', 'GalleryController@delete')->name('admin.gallery.delete');
                Route::post('/delete-ajax', 'GalleryController@deleteAjax')->name('admin.gallery.deleteAjax');
                Route::post('/all-delete-ajax', 'GalleryController@allDeleteAjax')->name('admin.gallery.allDeleteAjax');
                Route::get('/search', 'GalleryController@search')->name('admin.gallery.search');
                Route::get('/categories/{id}', 'GalleryController@categories')->name('admin.gallery.categories');

            });
        });
        /*   GALLERY END   */



        /*   GALLERY CATEGORY START   */
        Route::namespace('Gallery')->group(function () {
            Route::prefix('gallery/category/')->group(function () {
                Route::get('/', 'GalleryCategoryController@index')->name('admin.gallery.category.index');
                Route::get('/add', 'GalleryCategoryController@add')->name('admin.gallery.category.add');
                Route::post('/store', 'GalleryCategoryController@store')->name('admin.gallery.category.store');
                Route::get('/edit/{id}', 'GalleryCategoryController@edit')->name('admin.gallery.category.edit');
                Route::post('/update', 'GalleryCategoryController@update')->name('admin.gallery.category.update');
                Route::post('/slug', 'GalleryCategoryController@slug')->name('admin.gallery.category.slug');
                Route::post('/status-ajax', 'GalleryCategoryController@statusAjax')->name('admin.gallery.category.statusAjax');
                Route::post('/delete', 'GalleryCategoryController@delete')->name('admin.gallery.category.delete');
                Route::post('/delete-ajax', 'GalleryCategoryController@deleteAjax')->name('admin.gallery.category.deleteAjax');
                Route::post('/all-delete-ajax', 'GalleryCategoryController@allDeleteAjax')->name('admin.gallery.category.allDeleteAjax');
                Route::get('/search', 'GalleryCategoryController@search')->name('admin.gallery.category.search');

            });
        });
        /*   GALLERY CATEGORY END   */



        /*   SERVICE START   */
        Route::namespace('Service')->group(function () {
            Route::prefix('service')->group(function () {
                Route::get('/', 'ServiceController@index')->name('admin.service.index');
                Route::get('/add', 'ServiceController@add')->name('admin.service.add');
                Route::post('/store', 'ServiceController@store')->name('admin.service.store');
                Route::get('/edit/{id}', 'ServiceController@edit')->name('admin.service.edit');
                Route::post('/update', 'ServiceController@update')->name('admin.service.update');
                Route::post('/slug', 'ServiceController@slug')->name('admin.service.slug');
                Route::post('/status-ajax', 'ServiceController@statusAjax')->name('admin.service.statusAjax');
                Route::post('/delete', 'ServiceController@delete')->name('admin.service.delete');
                Route::post('/delete-ajax', 'ServiceController@deleteAjax')->name('admin.service.deleteAjax');
                Route::post('/all-delete-ajax', 'ServiceController@allDeleteAjax')->name('admin.service.allDeleteAjax');
                Route::post('/sort-ajax', 'ServiceController@sortAjax')->name('admin.service.sortAjax');
                Route::get('/search', 'ServiceController@search')->name('admin.service.search');
                Route::get('/categories/{id}', 'ServiceController@categories')->name('admin.service.categories');

            });
        });
        /*   SERVICE END   */



        /*   SERVICE CATEGORY START   */
//        Route::namespace('Service')->group(function () {
//            Route::prefix('service/category/')->group(function () {
//                Route::get('/', 'ServiceCategoryController@index')->name('admin.service.category.index');
//                Route::get('/add', 'ServiceCategoryController@add')->name('admin.service.category.add');
//                Route::post('/store', 'ServiceCategoryController@store')->name('admin.service.category.store');
//                Route::get('/edit/{id}', 'ServiceCategoryController@edit')->name('admin.service.category.edit');
//                Route::post('/update', 'ServiceCategoryController@update')->name('admin.service.category.update');
//                Route::post('/slug', 'ServiceCategoryController@slug')->name('admin.service.category.slug');
//                Route::post('/status-ajax', 'ServiceCategoryController@statusAjax')->name('admin.service.category.statusAjax');
//                Route::post('/delete', 'ServiceCategoryController@delete')->name('admin.service.category.delete');
//                Route::post('/delete-ajax', 'ServiceCategoryController@deleteAjax')->name('admin.service.category.deleteAjax');
//                Route::post('/all-delete-ajax', 'ServiceCategoryController@allDeleteAjax')->name('admin.service.category.allDeleteAjax');
//                Route::get('/search', 'ServiceCategoryController@search')->name('admin.service.category.search');
//
//            });
//        });
        /*   SERVICE CATEGORY END   */




        /*   PRODUCT START   */
        Route::namespace('Product')->group(function () {
            Route::prefix('product')->group(function () {
                Route::get('/', 'ProductController@index')->name('admin.product.index');
                Route::get('/add', 'ProductController@add')->name('admin.product.add');
                Route::post('/store', 'ProductController@store')->name('admin.product.store');
                Route::get('/edit/{id}', 'ProductController@edit')->name('admin.product.edit');
                Route::post('/update', 'ProductController@update')->name('admin.product.update');
                Route::post('/slug', 'ProductController@slug')->name('admin.product.slug');
                Route::post('/status-ajax', 'ProductController@statusAjax')->name('admin.product.statusAjax');
                Route::post('/delete', 'ProductController@delete')->name('admin.product.delete');
                Route::post('/delete-ajax', 'ProductController@deleteAjax')->name('admin.product.deleteAjax');
                Route::post('/all-delete-ajax', 'ProductController@allDeleteAjax')->name('admin.product.allDeleteAjax');
                Route::get('/search', 'ProductController@search')->name('admin.product.search');
                Route::get('/categories/{id}', 'ProductController@categories')->name('admin.product.categories');
                Route::get('/collections/{id}', 'ProductController@collections')->name('admin.product.collections');
                Route::get('/models/{id}', 'ProductController@models')->name('admin.product.models');
                Route::get('/manufacturers/{id}', 'ProductController@manufacturers')->name('admin.product.manufacturers');
                Route::post('/attribute-ajax', 'ProductController@getAttributeAjax')->name('admin.product.getAttributeAjax');
                Route::post('/attribute-add-ajax', 'ProductController@getAttributeAddAjax')->name('admin.product.getAttributeAddAjax');
                Route::post('/option-ajax', 'ProductController@getOptionAjax')->name('admin.product.getOptionAjax');
                Route::post('/option-add-ajax', 'ProductController@getOptionAddAjax')->name('admin.product.getOptionAddAjax');
                Route::get('/product-parent-ajax', 'ProductController@getProductParent')->name('admin.product.getProductParent');
                Route::get('/product-gallery-ajax', 'ProductController@getProductGallery')->name('admin.product.getProductGallery');

            });
        });
        /*   PRODUCT END   */



        /*   PRODUCT CATEGORY START   */
        Route::namespace('Product')->group(function () {
            Route::prefix('product/category/')->group(function () {
                Route::get('/', 'ProductCategoryController@index')->name('admin.product.category.index');
                Route::get('/add', 'ProductCategoryController@add')->name('admin.product.category.add');
                Route::post('/store', 'ProductCategoryController@store')->name('admin.product.category.store');
                Route::get('/edit/{id}', 'ProductCategoryController@edit')->name('admin.product.category.edit');
                Route::post('/update', 'ProductCategoryController@update')->name('admin.product.category.update');
                Route::post('/slug', 'ProductCategoryController@slug')->name('admin.product.category.slug');
                Route::post('/status-ajax', 'ProductCategoryController@statusAjax')->name('admin.product.category.statusAjax');
                Route::post('/delete', 'ProductCategoryController@delete')->name('admin.product.category.delete');
                Route::post('/delete-ajax', 'ProductCategoryController@deleteAjax')->name('admin.product.category.deleteAjax');
                Route::post('/all-delete-ajax', 'ProductCategoryController@allDeleteAjax')->name('admin.product.category.allDeleteAjax');
                Route::get('/search', 'ProductCategoryController@search')->name('admin.product.category.search');

            });
        });
        /*   PRODUCT CATEGORY END   */


        /*   PRODUCT COLLECTION START   */
        Route::namespace('Product')->group(function () {
            Route::prefix('product/collection/')->group(function () {
                Route::get('/', 'ProductCollectionController@index')->name('admin.product.collection.index');
                Route::get('/add', 'ProductCollectionController@add')->name('admin.product.collection.add');
                Route::post('/store', 'ProductCollectionController@store')->name('admin.product.collection.store');
                Route::get('/edit/{id}', 'ProductCollectionController@edit')->name('admin.product.collection.edit');
                Route::post('/update', 'ProductCollectionController@update')->name('admin.product.collection.update');
                Route::post('/slug', 'ProductCollectionController@slug')->name('admin.product.collection.slug');
                Route::post('/status-ajax', 'ProductCollectionController@statusAjax')->name('admin.product.collection.statusAjax');
                Route::post('/delete', 'ProductCollectionController@delete')->name('admin.product.collection.delete');
                Route::post('/delete-ajax', 'ProductCollectionController@deleteAjax')->name('admin.product.collection.deleteAjax');
                Route::post('/all-delete-ajax', 'ProductCollectionController@allDeleteAjax')->name('admin.product.collection.allDeleteAjax');
                Route::get('/search', 'ProductCollectionController@search')->name('admin.product.collection.search');

            });
        });
        /*   PRODUCT COLLECTION END   */


        /*   PRODUCT MODEL START   */
        Route::namespace('Product')->group(function () {
            Route::prefix('product/model/')->group(function () {
                Route::get('/', 'ProductModelController@index')->name('admin.product.model.index');
                Route::get('/add', 'ProductModelController@add')->name('admin.product.model.add');
                Route::post('/store', 'ProductModelController@store')->name('admin.product.model.store');
                Route::get('/edit/{id}', 'ProductModelController@edit')->name('admin.product.model.edit');
                Route::post('/update', 'ProductModelController@update')->name('admin.product.model.update');
                Route::post('/slug', 'ProductModelController@slug')->name('admin.product.model.slug');
                Route::post('/status-ajax', 'ProductModelController@statusAjax')->name('admin.product.model.statusAjax');
                Route::post('/delete', 'ProductModelController@delete')->name('admin.product.model.delete');
                Route::post('/delete-ajax', 'ProductModelController@deleteAjax')->name('admin.product.model.deleteAjax');
                Route::post('/all-delete-ajax', 'ProductModelController@allDeleteAjax')->name('admin.product.model.allDeleteAjax');
                Route::get('/search', 'ProductModelController@search')->name('admin.product.model.search');

            });
        });
        /*   PRODUCT MODEL END   */



        /*   PRODUCT MANUFACTURER START   */
        Route::namespace('Product')->group(function () {
            Route::prefix('product/manufacturer/')->group(function () {
                Route::get('/', 'ProductManufacturerController@index')->name('admin.product.manufacturer.index');
                Route::get('/add', 'ProductManufacturerController@add')->name('admin.product.manufacturer.add');
                Route::post('/store', 'ProductManufacturerController@store')->name('admin.product.manufacturer.store');
                Route::get('/edit/{id}', 'ProductManufacturerController@edit')->name('admin.product.manufacturer.edit');
                Route::post('/update', 'ProductManufacturerController@update')->name('admin.product.manufacturer.update');
                Route::post('/slug', 'ProductManufacturerController@slug')->name('admin.product.manufacturer.slug');
                Route::post('/status-ajax', 'ProductManufacturerController@statusAjax')->name('admin.product.manufacturer.statusAjax');
                Route::post('/delete', 'ProductManufacturerController@delete')->name('admin.product.manufacturer.delete');
                Route::post('/delete-ajax', 'ProductManufacturerController@deleteAjax')->name('admin.product.manufacturer.deleteAjax');
                Route::post('/all-delete-ajax', 'ProductManufacturerController@allDeleteAjax')->name('admin.product.manufacturer.allDeleteAjax');
                Route::get('/search', 'ProductManufacturerController@search')->name('admin.product.manufacturer.search');

            });
        });
        /*   PRODUCT MANUFACTURER END   */



        /*   ATTRIBUTE GROUP START   */
        Route::namespace('Attribute')->group(function () {
            Route::prefix('attribute/group/')->group(function () {
                Route::get('/', 'AttributeGroupController@index')->name('admin.attribute.group.index');
                Route::get('/add', 'AttributeGroupController@add')->name('admin.attribute.group.add');
                Route::post('/store', 'AttributeGroupController@store')->name('admin.attribute.group.store');
                Route::get('/edit/{id}', 'AttributeGroupController@edit')->name('admin.attribute.group.edit');
                Route::post('/update', 'AttributeGroupController@update')->name('admin.attribute.group.update');
                Route::post('/sort-ajax', 'AttributeGroupController@sortAjax')->name('admin.attribute.group.sortAjax');
                Route::post('/status-ajax', 'AttributeGroupController@statusAjax')->name('admin.attribute.group.statusAjax');
                Route::post('/delete', 'AttributeGroupController@delete')->name('admin.attribute.group.delete');
                Route::post('/delete-ajax', 'AttributeGroupController@deleteAjax')->name('admin.attribute.group.deleteAjax');
                Route::post('/all-delete', 'AttributeGroupController@allDelete')->name('admin.attribute.group.allDelete');
                Route::post('/all-delete-ajax', 'AttributeGroupController@allDeleteAjax')->name('admin.attribute.group.allDeleteAjax');
                Route::get('/search', 'AttributeGroupController@search')->name('admin.attribute.group.search');

            });
        });
        /*   ATTRIBUTE GROUP END   */


        /*   ATTRIBUTE  START   */
        Route::namespace('Attribute')->group(function () {
            Route::prefix('attribute/')->group(function () {
                Route::get('/', 'AttributeController@index')->name('admin.attribute.index');
                Route::get('/add', 'AttributeController@add')->name('admin.attribute.add');
                Route::post('/store', 'AttributeController@store')->name('admin.attribute.store');
                Route::get('/edit/{id}', 'AttributeController@edit')->name('admin.attribute.edit');
                Route::post('/update', 'AttributeController@update')->name('admin.attribute.update');
                Route::post('/sort-ajax', 'AttributeController@sortAjax')->name('admin.attribute.sortAjax');
                Route::post('/status-ajax', 'AttributeController@statusAjax')->name('admin.attribute.statusAjax');
                Route::post('/delete', 'AttributeController@delete')->name('admin.attribute.delete');
                Route::post('/delete-ajax', 'AttributeController@deleteAjax')->name('admin.attribute.deleteAjax');
                Route::post('/all-delete-ajax', 'AttributeController@allDeleteAjax')->name('admin.attribute.allDeleteAjax');
                Route::get('/search', 'AttributeController@search')->name('admin.attribute.search');
                Route::get('/list/{id}', 'AttributeController@list')->name('admin.attribute.list');

            });
        });
        /*   ATTRIBUTE  END   */




        /*   OPTION GROUP START   */
        Route::namespace('Option')->group(function () {
            Route::prefix('option/group/')->group(function () {
                Route::get('/', 'OptionGroupController@index')->name('admin.option.group.index');
                Route::get('/add', 'OptionGroupController@add')->name('admin.option.group.add');
                Route::post('/store', 'OptionGroupController@store')->name('admin.option.group.store');
                Route::get('/edit/{id}', 'OptionGroupController@edit')->name('admin.option.group.edit');
                Route::post('/update', 'OptionGroupController@update')->name('admin.option.group.update');
                Route::post('/sort-ajax', 'OptionGroupController@sortAjax')->name('admin.option.group.sortAjax');
                Route::post('/status-ajax', 'OptionGroupController@statusAjax')->name('admin.option.group.statusAjax');
                Route::post('/delete', 'OptionGroupController@delete')->name('admin.option.group.delete');
                Route::post('/delete-ajax', 'OptionGroupController@deleteAjax')->name('admin.option.group.deleteAjax');
                Route::post('/all-delete', 'OptionGroupController@allDelete')->name('admin.option.group.allDelete');
                Route::post('/all-delete-ajax', 'OptionGroupController@allDeleteAjax')->name('admin.option.group.allDeleteAjax');
                Route::get('/search', 'OptionGroupController@search')->name('admin.option.group.search');

            });
        });
        /*   OPTION GROUp END   */


        /*   OPTION  START   */
        Route::namespace('Option')->group(function () {
            Route::prefix('option/')->group(function () {
                Route::get('/', 'OptionController@index')->name('admin.option.index');
                Route::get('/add', 'OptionController@add')->name('admin.option.add');
                Route::post('/store', 'OptionController@store')->name('admin.option.store');
                Route::get('/edit/{id}', 'OptionController@edit')->name('admin.option.edit');
                Route::post('/update', 'OptionController@update')->name('admin.option.update');
                Route::post('/sort-ajax', 'OptionController@sortAjax')->name('admin.option.sortAjax');
                Route::post('/status-ajax', 'OptionController@statusAjax')->name('admin.option.statusAjax');
                Route::post('/delete', 'OptionController@delete')->name('admin.option.delete');
                Route::post('/delete-ajax', 'OptionController@deleteAjax')->name('admin.option.deleteAjax');
                Route::post('/all-delete-ajax', 'OptionController@allDeleteAjax')->name('admin.option.allDeleteAjax');
                Route::get('/search', 'OptionController@search')->name('admin.option.search');
                Route::get('/list/{id}', 'OptionController@list')->name('admin.option.list');
                Route::post('/option-add-ajax', 'OptionController@getOptionAddAjax')->name('admin.option.getOptionAddAjax');

            });
        });
        /*   OPTION  END   */





        /*   FILE MANAGER START   */
        Route::namespace('Filemanager')
            ->middleware(['FileManager'])
            ->group(function () {
                Route::get('/file-manager', 'FileManagerController@index')->name('admin.FileManager.index');
            });


        /*   FILE MANAGER END   */


        /*   CACHE CLEAR START  */
        Route::post('cache-clear', 'AdminController@cacheClear')->name('admin.cacheClear');
        /*   CACHE CLEAR END  */


    });
});
/* BACKEND END  */


/* LOGIN START  */
Route::prefix(env('APP_PANEL_NAME'))->group(function () {
    Route::get('/login', 'Auth\LoginController@index')->name('admin.login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');
});
/* LOGIN END  */


/*   LOGGER VIEW START   */
Route::prefix(env('APP_PANEL_NAME'))->middleware('auth')->group(function () {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('admin.logs');
});
/*   LOGGER VIEW END   */


/* FRONTEND START  */

Route::group(
    [
        'prefix' => LocalizationService::locale(),
        'middleware' => ['setLocale', 'Common']
    ],
    function () {
        Route::namespace('Frontend')->group(function () {

//            if (!request()->is('admin/*')) {
//               Route::fallback(function (){
//                  return view('frontend.errors.404');
//               });
//            }

            /*   HOME START   */
            Route::get('/', 'Home\HomeController@index')->name('frontend.home.index');
            /*   HOME END   */

            /*   CONTACT START   */
            Route::get('/contact', 'Home\HomeController@contact')->name('frontend.home.contact');
            Route::post('/contact-send-ajax', 'Home\HomeController@contactSendAjax')->name('frontend.home.contactSendAjax');
            /*   CONTACT END   */

            /*   PAGE START   */
            Route::get('/page/{slug}', 'Page\PageController@page')->name('frontend.page.index');
            /*   PAGE END   */

            /*   PRODUCTS START   */
            /*   PRODUCT START   */
//            Route::get('/products', 'Product\ProductController@index')->name('frontend.product.index');
//            Route::get('/product/{slug}', 'Product\ProductController@detail')->name('frontend.product.detail');
//            Route::get('/products/search/{search?}', 'Product\ProductController@search')->name('frontend.product.search');
            /*   PRODUCT END   */

            /*  PRODUCT CATEGORIES START   */
//            Route::get('/products/categories/{any?}', 'Product\CategoryController@index')->where('any', '.*')->name('frontend.product.category.index');
//            Route::get('/product/categories/{any?}', 'Product\CategoryController@detail')->where('any', '.*')->name('frontend.product.category.detail');
            /*  PRODUCT CATEGORIES END   */
            /*   PRODUCTS END   */



            /*   GALLERIES START   */
            /*   GALLERY START   */
//            Route::get('/galleries', 'Gallery\GalleryController@index')->name('frontend.gallery.index');
//            Route::get('/gallery/{slug}', 'Gallery\GalleryController@detail')->name('frontend.gallery.detail');
            /*   GALLERY END   */

            /*  GALLERY CATEGORIES START   */
//            Route::get('/galleries/categories/{any?}', 'Gallery\CategoryController@index')->where('any', '.*')->name('frontend.gallery.category.index');
//            Route::get('/gallery/categories/{any?}', 'Gallery\CategoryController@detail')->where('any', '.*')->name('frontend.gallery.category.detail');
            /*  GALLERY CATEGORIES END   */
            /*   GALLERIES END   */


            /*   SERVICE START   */
            Route::get('/services', 'Service\ServiceController@index')->name('frontend.service.index');
            Route::get('/service/{slug}', 'Service\ServiceController@detail')->name('frontend.service.detail');
            /*   SERVICE END   */

            /*   BLOG START   */
            Route::get('/blogs', 'Post\PostController@index')->name('frontend.post.index');
            Route::get('/blog/{slug}', 'Post\PostController@detail')->name('frontend.post.detail');
            /*   BLOG END   */



            /*   TEAM START   */
            Route::get('/teams', 'Team\TeamController@index')->name('frontend.team.index');
            Route::get('/team/{slug}', 'Team\TeamController@detail')->name('frontend.team.detail');
            /*   TEAM END   */



            //TEST UCUN OLAN HOME CONTROLLER START
//            Route::get('/home2', 'Home\HomeController@indexWelcome');
//            Route::get('/mail', 'Mail\SendMailController@send');
            //TEST UCUN OLAN HOME CONTROLLER END


            /*   LANGUAGE START  */
            /*   QEYD DIL DEYIHSIKILIYI OLDUQDA FRONTENDDE BURASI ISHLEYIR   */
            Route::namespace('Language')->group(function () {
                Route::prefix('language')->group(function () {
                    Route::post('/change', 'LanguageController@change')->name('frontend.language.change');
                });
            });
            /*   LANGUAGE END  */


            /*   SITEMAP START   */
            Route::get('/sitemap.xml', 'Sitemap\SitemapController@index')->name('frontend.sitemap.index');
            Route::get('/rss.xml', 'Sitemap\SitemapController@rss')->name('frontend.sitemap.rss');
            /*   SITEMAP END   */

        });
    });

/* FRONTEND END  */



