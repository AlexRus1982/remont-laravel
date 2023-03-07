<?php

    #region main requests
    Route::get('/', 'Products@showMain')->name('main');
    Route::get('/logout', 'Products@logout')->name('logout');

    Route::get('/offers', 'OffersController@showAll')->name('offers');

    Route::get('/offers/{id}', 'OffersController@showOffer')->name('offers.showOffer');

    Route::get('/products/{url}', 'Products@showCategory')->name('category');
    Route::get('/tags/{url}', 'Products@showTags')->name('products.tags');

    Route::get('/product/{url}', 'Products@show')->name('product');
    Route::put('/visited', 'Products@visited')->name('product.visited');
    Route::put('/wished', 'Products@wished')->name('product.wished');
    Route::delete('/wished/delete', 'Products@wishedDelete')->name('product.wished.delete');
    Route::get('/wished/list', 'Products@wishedList')->name('product.wished.list');

    Route::get('/service/{url}', 'Services@show')->name('service');

    Route::get('/search', 'Search@showSearchResult')->name('search');

    Route::get('/basket/index', 'BasketController@index')->name('basket.index');
    Route::get('/basket/checkout', 'BasketController@checkout')->name('basket.checkout');
    #endregion

    #region test requests
    Route::post('/test/get', function() {
        return '{"server_answer" : "success"}';
    });

    Route::get('/test', function() {
        $cookieUuid = Cookie::get('cookie-uuid');
        $uuid = ($cookieUuid != '') ? $cookieUuid : (string) Str::uuid();
        Config::set('cookie-uuid', $uuid);

        return response()->view('test')->cookie('cookie-uuid', Config::get('cookie-uuid'), 1);
    })->name('test');
    #endregion

    Auth::routes();
    // Route::get('/home', 'HomeController@index')->name('home');

    #region admin requests
    Route::view('/adminpanel', 'admin.adminpanel');

    Route::prefix('admin')->group(function(){

        //--------------------------------------------------------------------------------------------------------
        // перед всеми командами должно стоять /admin
        // во всех командах должно присутствовать поле 'token' со значением токена

        Route::get ('/products/list', 'WebController@GetProductsList')->name('products.list');
        
        Route::prefix('tags')->group(function(){
            Route::put   ('/', 'WebController@AddTags')->name('tags.add');
            Route::delete('/', 'WebController@DelTags')->name('tags.del');
            Route::put   ('/orders', 'WebController@SetTagsOrder')->name('tags.order');
        });

        Route::prefix('condition')->group(function(){
            Route::get ('/activetab', 'WebController@GetActiveTab')->name('condition.getActiveTab');
            Route::put ('/activetab', 'WebController@SetActiveTab')->name('condition.setActiveTab');
        });

        Route::prefix('categories')->group(function(){
            Route::post  ('/', 'WebController@categories')->name('categories.list');
            Route::post  ('/new', 'WebController@CreateCategory')->name('category.create');
            Route::put   ('/orders', 'WebController@SetCategoriesOrder')->name('categories.orders');
        });

        Route::put ('/products/orders', 'WebController@SetProductsOrder')->name('products.orders');

        Route::prefix('category')->group(function(){
            Route::post  ('/parent/{id}', 'WebController@categoryParent')->name('category.parent');
            Route::post  ('/info/{id}', 'WebController@categoryInfo')->name('category.info');
            Route::put   ('/save/{id}', 'WebController@SaveCategory')->name('category.save');
            Route::delete('/delete/{id}', 'WebController@DeleteCategory')->name('category.delete');
        });
        
        Route::prefix('products')->group(function(){
            Route::get   ('/short', 'WebController@ProductsShortList')->name('products.shortlist');
            Route::get   ('/notcategory', 'WebController@ProductsShortListNotCategory')->name('products.shortlist.notcategory');
            Route::get   ('/info/{id}', 'WebController@ProductInfo')->name('products.productInfo');
            Route::put   ('/save/{id}', 'WebController@ProductSave')->name('products.productSave');
            Route::get   ('/parent/{id}', 'WebController@ItemsForParent')->name('products.forparent');
            Route::put   ('/add', 'WebController@ProductsAddToCategory')->name('products.add_to_category');
            Route::delete('/category/delete', 'WebController@ProductsDeleteFromCategory')->name('products.delete_from_category');
        });
        

        Route::prefix('properties')->group(function(){
            // Route::get   ('/check', 'WebController@PropertiesCheck')->name('properties.check');
            Route::get   ('/list', 'WebController@PropertiesList')->name('properties.list');
            Route::get   ('/values', 'WebController@PropertiesValuesList')->name('properties.valuesList');
            Route::get   ('/valuesForm', 'WebController@PropertiesValuesForm')->name('properties.valuesForm');
            Route::put   ('/orders', 'WebController@SetPropertiesOrder')->name('properties.order');
            Route::put   ('/add', 'WebController@AddProperty')->name('properties.add');
            Route::put   ('/rename', 'WebController@RenameProperty')->name('properties.rename');
            Route::put   ('/filter/{id}', 'WebController@PropertySetFilter')->name('properties.inFilter');
            Route::put   ('/card/{id}', 'WebController@PropertySetCard')->name('properties.inCard');
            Route::delete('/delete', 'WebController@DelProperty')->name('properties.del');
        });

        Route::delete('/product/category/delete', 'WebController@ProductDeleteFromCategory')->name('product.delete_from_category');
        Route::post('/product/edit/form', function (Request $request) {
            return view('admin.includes.offcanvas.product_edit');
        });
        //--------------------------------------------------------------------------------------------------------
    });
    #endregion

?>