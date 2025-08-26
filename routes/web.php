<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SendUsAMessageController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\BlogController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/team', [FrontendController::class, 'team'])->name('team');
Route::get('/review', [FrontendController::class, 'review'])->name('review');
Route::get('/image-gallery', [FrontendController::class, 'imageGallery'])->name('image-gallery');
//Route::get('/video-gallery', [FrontendController::class, 'videoGallery'])->name('video-gallery');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/category-blog/{id}', [FrontendController::class, 'categoryBlog'])->name('category-blog');
Route::get('/menu-blog/{id}', [FrontendController::class, 'menuBlog'])->name('menu-blog');
Route::get('/blog-detail/{id}', [FrontendController::class, 'blogDetail'])->name('blog-detail');
Route::get('/ajax-search', [FrontendController::class, 'ajaxSearch'])->name('ajax-search');

Route::get('/ajax-home-search', [FrontendController::class, 'ajaxHomeSearch'])->name('ajax.home.search');

Route::get('/career', [FrontendController::class, 'career'])->name('career');
Route::get('/career-detail/{career}', [FrontendController::class, 'careerDetail'])->name('career-detail');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

Route::get('/get-categories/{menu_id}', [FrontendController::class, 'getCategories']);

Route::post('/subscribe-form', [SubscriberController::class, 'subscribe'])->name('subscribe');
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
Route::post('/send-us-message', [SendUsAMessageController::class, 'store'])->name('sendus.store');

 Route::middleware('auth')->group(function () {
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     Route::get('/subscribe/index', [SubscriberController::class, 'index'])->name('subscriber.index');
     Route::delete('{id}', [SubscriberController::class, 'destroy'])->name('subscriber.destroy');

     Route::get('/all-comments', [CommentController::class, 'index'])->name('comment.index');
     Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

     Route::get('/admin/send-us-messages', [SendUsAMessageController::class, 'index'])->name('sendus.index');
     Route::delete('/admin/send-us-messages/{id}', [SendUsAMessageController::class, 'destroy'])->name('sendus.destroy');
 });

require __DIR__.'/auth.php';

