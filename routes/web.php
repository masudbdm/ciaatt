<?php

use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMediaController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\categorySubcategory\CatSubcategoryController;
use App\Http\Controllers\Admin\EditorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

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



Route::get('/', [WelcomeController::class, 'welcome'])->name('user.welcome');
Route::get('/categories', [WelcomeController::class, 'categories'])->name('user.categories');
Route::get('/category-details/{category}', [WelcomeController::class, 'categoryDetails'])->name('user.categoryDetails');
Route::get('/details', [WelcomeController::class, 'details'])->name('user.details');
Route::get('/company-profile', [WelcomeController::class, 'companyProfile'])->name('user.companyProfile');
Route::get('/about-us', [WelcomeController::class, 'aboutUs'])->name('user.aboutUs');
Route::get('/teams', [WelcomeController::class, 'teams'])->name('user.teams');
Route::get('/contact-us', [WelcomeController::class, 'contactUs'])->name('user.contactUs');

Route::get('/team/{username}', [WelcomeController::class, 'teamShow'])->name('team.show');

Route::post('/information', [WelcomeController::class, 'information'])
->middleware('throttle:5,1')
->name('user.information');


Route::get('/post-details/{post}/{slug?}', [WelcomeController::class, 'postDetails'])->name('user.postDetails');

// Route::get('{url}/{menuId}', [WelcomeController::class, 'menuDetails'])->name('user.menuDetails');

Route::get('page/{url}/{page}', [WelcomeController::class, 'pageDetails'])->name('user.pageDetails');

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

///Language Start


Route::group(['prefix' => "{lan?}"], function () {
    Route::get('all-news', [WelcomeController::class, 'allNews'])->name('allNews');
    Route::get('news/{news}/details/', [WelcomeController::class, 'newsDetails'])->name('newsDetails');
});
Route::any('set/lan', [WelcomeController::class, 'setlan'])->name('setLan');


///Language End


Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('website-parameter', [AdminDashboardController::class, 'websiteParameter'])->name('admin.websiteParameter');
    Route::post('website/parameter/update', [AdminDashboardController::class, 'websiteParameterUpdate'])->name('admin.websiteParameterUpdate');

    //Menu and Pages START
    Route::get('new/menu', [AdminPageController::class, 'newMenu'])->name('admin.newMenu');
    Route::post('new/menu', [AdminPageController::class, 'storeNewMenu'])->name('admin.storeNewMenu');
    Route::get('all/menus', [AdminPageController::class, 'allMenus'])->name('admin.allMenus');
    Route::get('delete/menu/{menu}', [AdminPageController::class, 'deleteMenu'])->name('admin.deleteMenu');
    Route::get('edit/menu/{menu}', [AdminPageController::class, 'editMenu'])
    ->name('admin.editMenu');
    Route::post('update/menu/{menu}', [AdminPageController::class, 'updateMenu'])
    ->name('admin.updateMenu');
    Route::get('all/pages', [AdminPageController::class, 'pagesAll'])->name('admin.pagesAll');
    Route::post('all/pages', [AdminPageController::class, 'pageAddNewPost'])->name('admin.pageAddNewPost');
    Route::post('page/sort', [AdminPageController::class, 'pageSort'])->name('admin.pageSort');
    Route::get('page/{page}/edit', [AdminPageController::class, 'pageEdit'])->name('admin.pageEdit');
    Route::get('page/{page}/item', [AdminPageController::class, 'pageItems'])->name('admin.pageItems');
    Route::get('page/{page}/delete', [AdminPageController::class, 'pageDelete'])->name('admin.pageDelete');
    Route::get('page/edit/page/{page}', [AdminPageController::class, 'pageEditPost'])->name('admin.pageEditPost');
    Route::get('page/{page}/items/', [AdminPageController::class, 'pageItems'])->name('admin.pageItems');
    Route::post('page-item/add/post/{page}', [AdminPageController::class, 'pageItemAddPost'])->name('admin.pageItemAddPost');
    Route::get('page-item/edit/{item}', [AdminPageController::class, 'pageItemEdit'])->name('admin.pageItemEdit');
    Route::get('page-item/delete/{item}', [AdminPageController::class, 'pageItemDelete'])->name('admin.pageItemDelete');
    Route::post('page-item/delete/{item}', [AdminPageController::class, 'pageItemUpdate'])->name('admin.pageItemUpdate');
    Route::get('page-item/edit-editor/{item}', [AdminPageController::class, 'pageItemEditEditor'])->name('admin.pageItemEditEditor');
    //Menu and Pages END

    //media Start
    Route::get('media/all', [AdminMediaController::class, 'mediaAll'])->name('admin.mediaAll');
    Route::get('media/all/ajax', [AdminMediaController::class, 'mediaAllAjax'])->name('admin.mediaAllAjax');
    Route::post('media/upload', [AdminMediaController::class, 'mediaUpload'])->name('admin.mediaUpload');
    Route::post('media/upload/dropzon', [AdminMediaController::class, 'mediaUploadDropZon'])->name('admin.mediaUploadDropZon');
    Route::get('media/{media}/delete', [AdminMediaController::class, 'mediaDelete'])->name('admin.mediaDelete');

    //media End

    //Role and Permission Start
    Route::resource('roles', RoleController::class);
    Route::get('assign/role', [RoleController::class, 'assignRole'])->name('assignRole');
    Route::post('assign/role', [RoleController::class, 'assignRolePost'])->name('assignRolePost');
    Route::resource('permissions', PermissionController::class);
    Route::get('select/user/for/assign/role', [AdminDashboardController::class, 'selectUserForAssignRole'])->name('admin.selectUserForAssignRole');
    //Role and Permission End

    //Users Start
    Route::resource('users', UserController::class);
    //Users End

    //Category Subcategory START With tree ans Drag/drop
    Route::get('select/categories/all', [CatSubcategoryController::class, 'allCategory'])->name('admin.allCategory');
    Route::post('category/add/new/post', [CatSubcategoryController::class, 'categoryAddNewPost'])->name('admin.categoryAddNewPost');
    Route::post('cat/sort', [CatSubcategoryController::class, 'catSort'])->name('admin.catSort');
    Route::any('category/delete/{cat}', [CatSubcategoryController::class, 'categoryDelete'])->name('admin.categoryDelete');
    Route::any('category/edit/{cat}', [CatSubcategoryController::class, 'categoryEdit'])->name('admin.categoryEdit');
    Route::post('category/update/{cat}/lan/{lan}', [CatSubcategoryController::class, 'categoryUpdate'])->name('admin.categoryUpdate');
    Route::post('subcat/add/new/cat/{cat}', [CatSubcategoryController::class, 'subcatAddNew'])->name('admin.subcatAddNew');
    Route::any('subcat/edit/subcat/{subcat}', [CatSubcategoryController::class, 'subcatEdit'])->name('admin.subcatEdit');
    Route::any('subcat/update/subcat/{subcat}/lan/{lan}', [CatSubcategoryController::class, 'subcatUpdate'])->name('admin.subcatUpdate');
    Route::any('subcat/delete/subcat/{subcat}', [CatSubcategoryController::class, 'subcatDelete'])->name('admin.subcatDelete');
    //Category Subcategory END With tree ans Drag/drop

    //Posts Start
    Route::get('add/new/post', [EditorController::class, 'addNewPost'])->name('admin.addNewPost');
    Route::post('store/new/post', [EditorController::class, 'storePost'])->name('admin.storePost');
    Route::get('all/posts', [EditorController::class, 'allPost'])->name('admin.allPost');
    Route::get('edit/post/{post}', [EditorController::class, 'editPost'])->name('admin.editPost');
    Route::post('update/post/{post}', [EditorController::class, 'updtePost'])->name('admin.updtePost');
    Route::get('post/{slug}', [EditorController::class, 'viewPost'])->name('admin.viewPost');
    Route::get('select/tags/or/add', [EditorController::class, 'selectTagsOrAddNew'])->name('admin.selectTagsOrAddNew');
    //Post End

    //Image Gallery START
    Route::get('image/gallery/all', [AdminMediaController::class, 'imageGalleriesAll'])->name('admin.imageGalleriesAll');
    Route::get('image/gallery/add/new', [AdminMediaController::class, 'addNewImageGallery'])->name('admin.addNewImageGallery');
    Route::post('image/gallery/store', [AdminMediaController::class, 'imgGalleryAddNewPost'])->name('admin.imgGalleryAddNewPost');
    Route::any('image/gallery/item/ajax/post/{item}', [AdminMediaController::class, 'imgGalleryItemAjaxPost'])->name('admin.imgGalleryItemAjaxPost');

    Route::any('image/gallery/edit/{gallery}', [AdminMediaController::class, 'imgGalleryEdit'])->name('admin.imgGalleryEdit');
    Route::any('gallery/{gallery}', [AdminMediaController::class, 'gallery'])->name('welcome.gallery');
    Route::any('/image/gallery/delete/{gallery}', [AdminMediaController::class, 'imgGalleryDelete'])->name('admin.imgGalleryDelete');
    Route::get('/image/gallery/edit/post/{gallery}', [AdminMediaController::class, 'imgGalleryEditPost'])->name('admin.imgGalleryEditPost');

    Route::any('/feature/image/delete/{post}', [AdminMediaController::class, 'featureImageDelete'])->name('admin.featureImageDelete');

/////Gallery Ajax
Route::any('/image/details/{media}', [AdminMediaController::class, 'imageDetails'])->name('imageDetails');


    //Image Gallery END

    //Video Gallery START
    Route::get('video/gallery/all', [AdminMediaController::class, 'videoGalleriesAll'])->name('admin.videoGalleriesAll');
    Route::get('add/video/gallery', [AdminMediaController::class, 'addVideoGallery'])->name('admin.addVideoGallery');
    Route::post('store/video/gallery/{gallery}', [AdminMediaController::class, 'storeVideoGallery'])->name('admin.storeVideoGallery');
    Route::get('edit/video/gallery/{gallery}', [AdminMediaController::class, 'editVideoGallery'])->name('admin.editVideoGallery');
    Route::post('update/video/gallery/{gallery}', [AdminMediaController::class, 'updateVideoGallery'])->name('admin.updateVideoGallery');
    Route::delete('delete/video/gallery/{gallery}', [AdminMediaController::class, 'deleteVideoGallery'])->name('admin.deleteVideoGallery');

    //Video Gallery END

    // Contact Us
    Route::get('customer-message', [AdminCustomerController::class, 'contactUs'])
        ->name('admin.contactUs');

    Route::delete('customer-message/{id}', [AdminCustomerController::class, 'destroy'])
        ->name('admin.contactUs.delete');

    Route::get('customer-message-export', [AdminCustomerController::class, 'export'])
        ->name('admin.contactUs.export');

    // Contact Us End



        //team start

        Route::resource('teams', TeamController::class);
        Route::post('/admin/teams/reorder', 
            [TeamController::class, 'reorder']
        )->name('teams.reorder');


});

//Google Login
Route::get('login/google', [WelcomeController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [WelcomeController::class, 'handleGoogleCallback']);

//Facebook Login
Route::get('login/facebook', [WelcomeController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [WelcomeController::class, 'handleFacebookCallback']);

Route::get('/image', function () {
    \Artisan::call('storage:link');
    return redirect()->route('user.welcome');
});

Route::get('/cache', function () {
    \Artisan::call('optimize:clear');
    return redirect()->route('user.welcome');
});

