<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
//use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\SocialIconController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\ImageGalleryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\VideoGalleryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\JobApplyController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\StudentController;


Route::prefix('admin')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('dashboard', [DashboardController::class, 'editorDashboard'])->name('admin.dashboard');
    Route::get('dashboard', [DashboardController::class, 'userDashboard'])->name('admin.dashboard');

    // User Management
    Route::prefix('user')->group(function () {
        Route::get('create', [UserController::class, 'userCreate'])->name('user.create');
        Route::post('store', [UserController::class, 'storeUser'])->name('user.store');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit.user');
        Route::post('{id}/update', [UserController::class, 'updateUser'])->name('update.user');
        Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
        Route::post('profile/{id}/image', [UserController::class, 'profileImageUpdate'])->name('update.profile.image');
        Route::post('password/{id}/change', [UserController::class, 'passwordUpdate'])->name('update.password');
        Route::delete('delete/{id}', [UserController::class, 'destroyUser'])->name('user.destroy');
    });

    // Website Settings
    Route::prefix('website')->group(function () {
        Route::get('setting', [WebsiteSettingController::class, 'websiteSetting'])->name('website_setting');
        Route::post('setting/update', [WebsiteSettingController::class, 'websiteSettingUpdate'])->name('website_setting.update');
        Route::post('footer-info/update', [WebsiteSettingController::class, 'footerInfoSettingUpdate'])->name('website_footer_info.update');

        Route::get('social-icon', [SocialIconController::class, 'socialIcon'])->name('website_social_icon.index');
        Route::post('social-icon/update', [SocialIconController::class, 'socialIconUpdate'])->name('website_social_icon.update');
    });

    // Admin Panel Settings
    Route::prefix('admin-panel')->group(function () {
        Route::get('setting', [AdminPanelController::class, 'adminPanelSetting'])->name('admin_panel_setting');
        Route::post('setting/update', [AdminPanelController::class, 'adminPanelSettingUpdate'])->name('admin_panel_setting.update');
    });

    // Home Page Sections
    Route::prefix('home-page')->group(function () {

        // Sliders
        Route::prefix('slider')->group(function () {
            Route::get('/', [SliderController::class, 'index'])->name('slider.index');
            Route::get('create', [SliderController::class, 'create'])->name('slider.create');
            Route::post('store', [SliderController::class, 'store'])->name('slider.store');
            Route::get('edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
            Route::put('update/{id}', [SliderController::class, 'update'])->name('slider.update');
            Route::delete('destroy/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
        });

        // Feature
        Route::prefix('feature')->group(function () {
            Route::get('/', [FeatureController::class, 'index'])->name('feature.index');
            Route::get('create', [FeatureController::class, 'create'])->name('feature.create');
            Route::post('store', [FeatureController::class, 'store'])->name('feature.store');
            Route::get('edit/{id}', [FeatureController::class, 'edit'])->name('feature.edit');
            Route::put('update/{id}', [FeatureController::class, 'update'])->name('feature.update');
            Route::delete('destroy/{id}', [FeatureController::class, 'destroy'])->name('feature.destroy');
        });

        // About
        Route::get('about', [AboutController::class, 'index'])->name('about.index');
        Route::post('about/update', [AboutController::class, 'update'])->name('about.update');

        // Image Gallery
        Route::prefix('image-gallery')->group(function () {
            Route::get('/', [ImageGalleryController::class, 'index'])->name('image-gallery.index');
            Route::get('create', [ImageGalleryController::class, 'create'])->name('image-gallery.create');
            Route::post('store', [ImageGalleryController::class, 'store'])->name('image-gallery.store');
            Route::get('edit/{id}', [ImageGalleryController::class, 'edit'])->name('image-gallery.edit');
            Route::put('update/{id}', [ImageGalleryController::class, 'update'])->name('image-gallery.update');
            Route::delete('destroy/{id}', [ImageGalleryController::class, 'destroy'])->name('image-gallery.destroy');
        });

        // Video Gallery
        Route::prefix('video-gallery')->group(function () {
            Route::get('/', [VideoGalleryController::class, 'index'])->name('video-gallery.index');
            Route::get('create', [VideoGalleryController::class, 'create'])->name('video-gallery.create');
            Route::post('store', [VideoGalleryController::class, 'store'])->name('video-gallery.store');
            Route::get('edit/{id}', [VideoGalleryController::class, 'edit'])->name('video-gallery.edit');
            Route::put('update/{id}', [VideoGalleryController::class, 'update'])->name('video-gallery.update');
            Route::delete('destroy/{id}', [VideoGalleryController::class, 'destroy'])->name('video-gallery.destroy');
        });

        // Location URL
        Route::prefix('location')->group(function () {
            Route::get('/', [LocationController::class, 'index'])->name('location.index');
            Route::get('create', [LocationController::class, 'create'])->name('location.create');
            Route::post('store', [LocationController::class, 'store'])->name('location.store');
            Route::get('edit/{id}', [LocationController::class, 'edit'])->name('location.edit');
            Route::put('update/{id}', [LocationController::class, 'update'])->name('location.update');
            Route::delete('destroy/{id}', [LocationController::class, 'destroy'])->name('location.destroy');
        });

        // Reviews
        Route::prefix('review')->group(function () {
            Route::get('/', [ReviewController::class, 'index'])->name('review.index');
            Route::get('create', [ReviewController::class, 'create'])->name('review.create');
            Route::post('store', [ReviewController::class, 'store'])->name('review.store');
            Route::get('edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');
            Route::put('update/{id}', [ReviewController::class, 'update'])->name('review.update');
            Route::delete('destroy/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
        });

        // Team
        Route::prefix('team')->group(function () {
            Route::get('/', [TeamController::class, 'index'])->name('team.index');
            Route::get('create', [TeamController::class, 'create'])->name('team.create');
            Route::get('contact', [TeamController::class, 'contact'])->name('team.contact');
            Route::post('store', [TeamController::class, 'store'])->name('team.store');
            Route::get('edit/{id}', [TeamController::class, 'edit'])->name('team.edit');
            Route::put('update/{id}', [TeamController::class, 'update'])->name('team.update');
            Route::delete('destroy/{id}', [TeamController::class, 'destroy'])->name('team.destroy');
        });

        // Blog
        Route::prefix('blog')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('blog.index');
            Route::get('create', [BlogController::class, 'create'])->name('blog.create');
            Route::get('contact', [BlogController::class, 'contact'])->name('blog.contact');
            Route::post('store', [BlogController::class, 'store'])->name('blog.store');
            Route::post('copy/{blog}', [BlogController::class, 'copy'])->name('blog.copy');
            Route::get('edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
            Route::put('update/{id}', [BlogController::class, 'update'])->name('blog.update');
            Route::delete('destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
        });

//        // FAQs
//        Route::resource('faq', FaqController::class);

    });

    // Menu
    Route::resource('menu', MenuController ::class);

    // Category
    Route::resource('category', CategoryController::class);

    // Career
    Route::resource('career', CareerController::class);

    // Job Apply
    Route::resource('job-apply', JobApplyController::class);
    Route::resource('career', CareerController::class);

    // Student
    Route::resource('student', StudentController::class);

});