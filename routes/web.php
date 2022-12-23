<?php
use Illuminate\Foundation\Auth\User;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\User\AlbumController;

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

Route::group(['prefix'=>'user', 'namespace'=>'User', 'middleware'=>['auth']], function(){
    Route::get('/', 'DashboardController@dashboard')->name('user.index');
    Route::resource('/news', 'NewsController', ['as'=>'user']);
    Route::post('/news/{news}', 'NewsController@update', ['as'=>'user'])->name('user.news.update');
    Route::resource('/slider', 'SliderController', ['as'=>'user']);
    Route::resource('/partners', 'PartnersSliderController', ['as'=>'user']);
    Route::resource('/pages', 'PagesController', ['as' => 'user'])->except(['create', 'store', 'destroy']);
    // Route::resource('/six_photo', 'SixPhotoController', ['as'=>'user']);

    // new selectPhoto
    Route::group(['prefix' => 'select-photo'], function () {
        Route::post('/upload-photo', 'SelectPhotoController@uploadPhoto')->name('user.select-photo.image.upload');
        Route::post('/destroy-photo', 'SelectPhotoController@destroyPhoto')->name('user.select-photo.image.destroy');    
    });
    Route::resource('/select-photo', 'SelectPhotoController', ['as' => 'user'])->except(['create', 'show', 'edit', 'update', 'destroy']);

    // gallery
    Route::group(['prefix' => 'photo-gallery'], function () {
        Route::post('/{photo_gallery}', 'PhotoGalleryController@update')->name('user.photo-gallery.update');
        Route::post('/image/upload-photo', 'PhotoGalleryController@uploadPhoto')->name('user.photo-gallery.image.upload');
        Route::post('/image/destroy-photo', 'PhotoGalleryController@destroyPhoto')->name('user.photo-gallery.image.destroy');    
    });
    Route::resource('/photo-gallery', 'PhotoGalleryController', ['as' => 'user']);

    Route::group(['prefix' => 'albumchange'], function() {
        Route::get('/', 'AlbumController@index')->name('albumchange.index');
    });

    Route::group(['prefix' => 'news/image'], function() {
        Route::get('/', 'ImageController@index')->name('image.index');
        Route::post('/upload', 'ImageController@upload')->name('image.upload');
        Route::post('/destroy', 'ImageController@destroy')->name('image.destroy');
    });

    Route::resource('/blocks', 'BlockController', ['as' => 'user'])->except(['create', 'store', 'destroy']);
    Route::resource('/emploee', 'EmploeeController', ['as' => 'user']);
});


// Front route
Route::get('/', 'HomeController@index')->name('welcome');

//api for article
Route::get('/loadMore', 'HomeController@loadMore')->name('loadMore');
Route::get('/endList', 'HomeController@endList')->name('endList');
Route::get('/albumsVue', 'HomeController@albumsVue')->name('albumsVue');

// end api

Route::get('/news', 'HomeController@news')->name('news');
Route::get('/news/{slug}', 'HomeController@cur_news')->name('cur_news');
Route::get('/map', 'HomeController@map')->name('map');
Route::get('/volunteer', 'HomeController@volunteer')->name('volunteer');
Route::get('/scholarship', 'HomeController@scholarship')->name('scholarship');
Route::get('/albums', 'HomeController@albums')->name('albums');
Route::get('/album', 'HomeController@album')->name('album');
Route::get('/social', 'HomeController@social')->name('social');
Route::get('/social-photo', 'HomeController@getSocialPhoto')->name('social.photo');
Route::get('/department', 'HomeController@department')->name('department');
Route::get('/search', 'HomeController@search')->name('search');

// End front route

Auth::routes(['register' => false, 'reset' => false]);

// Super Admin
Route::prefix('admin')->group( function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::resource('/configs', 'Admin\ConfigController', ['as' => 'admin'])->except([
        'create', 'show', 'store', 'destroy'
    ]);
    Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
    Route::group(['prefix' => 'user-management', 'namespace' => 'Admin\UserManagement'], function() {
        Route::resource('/users', 'UserController', ['as' => 'admin.user-management'])->except('show');
        Route::resource('/admins', 'AdminController', ['as' => 'admin.user-management'])->except('show');
    });
});

// custom method for user logout
Route::post('user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

