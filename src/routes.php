<?php

Route::group(['prefix' => config('adminamazing.path').'/apilog', 'middleware' => ['web', 'CheckAccess']], function(){
	Route::get('/', 'selfreliance\Apilog\ApiLogController@index')->name('AdminApiLog');
});