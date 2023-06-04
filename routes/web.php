<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home.index');
// });
Route::group(['middleware' => ['guest']], function() {
    Route::get('/', 'LoginController@login')->name('login');
    Route::post('/login', 'LoginController@authenticate')->name('login.post');
});
Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/logout', 'LoginController@logout')->name('logout');

    Route::group(['prefix' => 'user'], function() {
        Route::get('/', 'UserController@index')->name('user.index');
        Route::get('/list', 'UserController@list')->name('user.list');
        Route::post('/create', 'UserController@store')->name('user.store');
        Route::get('/edit', 'UserController@edit')->name('user.edit');
        Route::post('/update', 'UserController@update')->name('user.update');
        Route::post('/delete', 'UserController@destroy')->name('user.destroy');
        Route::post('/updatepwd', 'UserController@updatepwd')->name('user.updatepwd');
    });   

    Route::group(['prefix' => 'paslon'], function() {
        Route::get('/', 'PaslonController@index')->name('paslon.index');
        Route::get('/list', 'PaslonController@list')->name('paslon.list');
        Route::post('/create', 'PaslonController@store')->name('paslon.store');
        Route::get('/edit', 'PaslonController@edit')->name('paslon.edit');
        Route::post('/update', 'PaslonController@update')->name('paslon.update');
    });   

    Route::group(['prefix' => 'tps'], function() {
        Route::get('/', 'TpsController@index')->name('tps.index');
    });  
    
    Route::group(['prefix' => 'relawan'], function() {
        Route::get('/', 'RelawanController@index')->name('relawan.index');
    }); 
    
    Route::group(['prefix' => 'pendukung'], function() {
        Route::get('/', 'PendukungController@index')->name('pendukung.index');
    }); 

    Route::group(['prefix' => 'saksi'], function() {
        Route::get('/', 'SaksiController@index')->name('saksi.index');
    }); 

    Route::group(['prefix' => 'dpt'], function() {
        Route::get('/', 'DptController@index')->name('dpt.index');
    });

    Route::group(['prefix' => 'survey'], function() {
        Route::get('/', 'SurveyController@index')->name('survey.index');
    });

    Route::group(['prefix' => 'quick'], function() {
        Route::get('/', 'QuickController@index')->name('quick.index');
    });

    Route::group(['prefix' => 'real'], function() {
        Route::get('/', 'RealController@index')->name('real.index');
    });

    Route::group(['prefix' => 'orderitem'], function() {
        Route::get('/', 'OrderItemController@index')->name('orderitem.index');
    });

    Route::group(['prefix' => 'inbarang'], function() {
        Route::get('/', 'InbarangController@index')->name('inbarang.index');
    });

    Route::group(['prefix' => 'outbarang'], function() {
        Route::get('/', 'OutbarangController@index')->name('outbarang.index');
    });

    Route::group(['prefix' => 'rekapdpt'], function() {
        Route::get('/', 'RekapdptController@index')->name('rekapdpt.index');
    });

    Route::group(['prefix' => 'rekapsurvey'], function() {
        Route::get('/', 'RekapSurveyController@index')->name('rekapsurvey.index');
    });

    Route::group(['prefix' => 'rekapquick'], function() {
        Route::get('/', 'RekapQuickController@index')->name('rekapquick.index');
    });

    Route::group(['prefix' => 'rekapreal'], function() {
        Route::get('/', 'RekapRealController@index')->name('rekapreal.index');
    });

    Route::group(['prefix' => 'stokbarang'], function() {
        Route::get('/', 'StokbarangController@index')->name('stokbarang.index');
    });
});