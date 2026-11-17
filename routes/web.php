<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\HomePathwayController;
use App\Http\Controllers\Admin\GalleryItemController;
use App\Http\Controllers\Admin\NewsPostController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\TrackingController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/who-we-are', [PublicPageController::class, 'about'])->name('about');
Route::get('/gallery', [PublicPageController::class, 'gallery'])->name('gallery');
Route::get('/video-gallery', [PublicPageController::class, 'videos'])->name('videos');
Route::get('/news-pr', [PublicPageController::class, 'news'])->name('news');
Route::get('/news-pr/{newsPost:slug}', [PublicPageController::class, 'newsShow'])->name('news.show');
Route::get('/contact-us', [PublicPageController::class, 'contact'])->name('contact');
Route::post('/contact-us', [PublicPageController::class, 'submitContact'])->middleware('throttle:5,1')->name('contact.submit');
Route::get('/programs', [PublicPageController::class, 'programs'])->name('programs');

foreach (['events', 'donate'] as $page) {
    Route::get('/'.$page, [PublicPageController::class, 'generic'])->defaults('slug', $page)->name(str_replace('-', '.', $page));
}

Route::redirect('/get-involved', '/contact-us');

Route::middleware('guest')->group(function (): void {
    Route::get('/admin/login', [AuthController::class, 'create'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'store'])->name('admin.login.store');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (): void {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/{page}/hero-slides', [HeroSlideController::class, 'index'])->name('hero-slides.index');
    Route::post('/pages/{page}/hero-slides', [HeroSlideController::class, 'store'])->name('hero-slides.store');
    Route::put('/pages/{page}/hero-slides/{heroSlide}', [HeroSlideController::class, 'update'])->name('hero-slides.update');
    Route::delete('/pages/{page}/hero-slides/{heroSlide}', [HeroSlideController::class, 'destroy'])->name('hero-slides.destroy');
    Route::get('/pages/{page}/home-pathways', [HomePathwayController::class, 'index'])->name('home-pathways.index');
    Route::post('/pages/{page}/home-pathways', [HomePathwayController::class, 'store'])->name('home-pathways.store');
    Route::put('/pages/{page}/home-pathways/{homePathway}', [HomePathwayController::class, 'update'])->name('home-pathways.update');
    Route::delete('/pages/{page}/home-pathways/{homePathway}', [HomePathwayController::class, 'destroy'])->name('home-pathways.destroy');
    Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
    Route::get('/navigation', [NavigationController::class, 'index'])->name('navigation.index');
    Route::put('/navigation', [NavigationController::class, 'update'])->name('navigation.update');
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/seo', [SeoController::class, 'edit'])->name('seo.edit');
    Route::put('/seo', [SeoController::class, 'update'])->name('seo.update');
    Route::get('/tracking', [TrackingController::class, 'edit'])->name('tracking.edit');
    Route::put('/tracking', [TrackingController::class, 'update'])->name('tracking.update');
    Route::get('/social-media', [SocialController::class, 'edit'])->name('social.edit');
    Route::put('/social-media', [SocialController::class, 'update'])->name('social.update');
    Route::resource('gallery-items', GalleryItemController::class)->except('show')->parameters(['gallery-items' => 'galleryItem'])->names('gallery');
    Route::resource('news-posts', NewsPostController::class)->except('show')->parameters(['news-posts' => 'newsPost'])->names('news');
    Route::get('/{module}', ModuleController::class)
        ->whereIn('module', ['programs', 'events', 'media', 'inquiries'])
        ->name('module');
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
});
