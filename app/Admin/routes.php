<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('/shop/category', CategoryController::class);
    $router->resource('/shop/goods', GoodsController::class);
    $router->resource('/shop/order', OrderController::class);
    $router->resource('/shop/vedio', VedioController::class);
    $router->resource('/shop/comment', CommentController::class);
});


