<?php

use App\Http\Controllers\ApiController;

Route::post('/services/pagecontent/{url}', [ApiController::class, 'GetServicePageContent']);
Route::post('/services/pagecontent/{url}/save', [ApiController::class, 'SaveServicePageContent']);

Route::post('/basket/getcount', [ApiController::class, 'BasketGetCount']);

Route::post('/basket/add', [ApiController::class, 'BasketAdd']);
Route::post('/basket/inc', [ApiController::class, 'BasketInc']);
Route::post('/basket/dec', [ApiController::class, 'BasketDec']);

Route::post('/basket/remove', [ApiController::class, 'BasketRemove']);

Route::post('/basket/list', [ApiController::class, 'BasketList']);

Route::post('/order/close', [ApiController::class, 'CloseOrder']);

Route::post('/order/hash', [ApiController::class, 'GetOrderHash']);

Route::post('/order/products', [ApiController::class, 'GetOrderProducts']);

Route::post('/orders', [ApiController::class, 'GetOrdersList']);
