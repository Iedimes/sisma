<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('brackets/admin-auth::admin.auth.login');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('memos')->name('memos/')->group(static function() {
            Route::get('/',                                             'MemosController@index')->name('index');
            Route::get('/create',                                       'MemosController@create')->name('create');
            Route::post('/',                                            'MemosController@store')->name('store');
            Route::get('/{memo}/edit',                                  'MemosController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'MemosController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{memo}',                                      'MemosController@update')->name('update');
            Route::get('/{memo}/show',                                  'MemosController@show')->name('show');
            Route::get('/{memo}/createdetail',                          'MemosController@createdetail')->name('createdetail');
            Route::delete('/{memo}',                                    'MemosController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('dependencies')->name('dependencies/')->group(static function() {
            Route::get('/',                                             'DependenciesController@index')->name('index');
            Route::get('/create',                                       'DependenciesController@create')->name('create');
            Route::post('/',                                            'DependenciesController@store')->name('store');
            Route::get('/{dependency}/edit',                            'DependenciesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'DependenciesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{dependency}',                                'DependenciesController@update')->name('update');
            Route::delete('/{dependency}',                              'DependenciesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('states')->name('states/')->group(static function() {
            Route::get('/',                                             'StatesController@index')->name('index');
            Route::get('/create',                                       'StatesController@create')->name('create');
            Route::post('/',                                            'StatesController@store')->name('store');
            Route::get('/{state}/edit',                                 'StatesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'StatesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{state}',                                     'StatesController@update')->name('update');
            Route::delete('/{state}',                                   'StatesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('doc-types')->name('doc-types/')->group(static function() {
            Route::get('/',                                             'DocTypesController@index')->name('index');
            Route::get('/create',                                       'DocTypesController@create')->name('create');
            Route::post('/',                                            'DocTypesController@store')->name('store');
            Route::get('/{docType}/edit',                               'DocTypesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'DocTypesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{docType}',                                   'DocTypesController@update')->name('update');
            Route::delete('/{docType}',                                 'DocTypesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('user-cedulas')->name('user-cedulas/')->group(static function() {
            Route::get('/',                                             'UserCedulasController@index')->name('index');
            Route::get('/create',                                       'UserCedulasController@create')->name('create');
            Route::post('/',                                            'UserCedulasController@store')->name('store');
            Route::get('/{userCedula}/edit',                            'UserCedulasController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'UserCedulasController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{userCedula}',                                'UserCedulasController@update')->name('update');
            Route::delete('/{userCedula}',                              'UserCedulasController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('detail-memos')->name('detail-memos/')->group(static function() {
            Route::get('/',                                             'DetailMemosController@index')->name('index');
            Route::get('/create',                                       'DetailMemosController@create')->name('create');
            Route::post('/',                                            'DetailMemosController@store')->name('store');
            Route::get('/{detailMemo}/edit',                            'DetailMemosController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'DetailMemosController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{detailMemo}',                                'DetailMemosController@update')->name('update');
            Route::delete('/{detailMemo}',                              'DetailMemosController@destroy')->name('destroy');
            Route::get('/{detailMemo}/actualizar',                      'DetailMemosController@actualizar')->name('actualizar');
            Route::get('/{detailMemo}/enviar',                          'DetailMemosController@enviar')->name('enviar');
            Route::get('/{detailMemo}/pdf',                             'DetailMemosController@pdf')->name('pdf');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('media')->name('media/')->group(static function() {
            Route::get('/',                                             'MediaController@index')->name('index');
            Route::get('/create',                                       'MediaController@create')->name('create');
            Route::post('/',                                            'MediaController@store')->name('store');
            Route::get('/{medium}/edit',                                'MediaController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'MediaController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{medium}',                                    'MediaController@update')->name('update');
            Route::delete('/{medium}',                                  'MediaController@destroy')->name('destroy');
        });
    });
});
