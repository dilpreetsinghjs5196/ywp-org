<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CampaignController;

use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;
use App\Http\Controllers\Admin\ProfessionalController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\AnnualReportController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogPostController;

use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DonationController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/our-mission', [HomeController::class, 'ourMission'])->name('our-mission');
Route::get('/history', [HomeController::class, 'history'])->name('history');
Route::get('/advisory-board', [HomeController::class, 'advisoryBoard'])->name('advisory-board');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/research-papers', [HomeController::class, 'researchPapers'])->name('research-papers');
Route::get('/policies', [HomeController::class, 'policies'])->name('policies');
Route::get('/reports', [HomeController::class, 'reports'])->name('reports');
Route::get('/newsletters', [HomeController::class, 'newsletters'])->name('newsletters');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::get('/donate', [DonationController::class, 'showDonate'])->name('donate');
Route::post('/donate/initiate', [DonationController::class, 'initiateCheckout'])->name('donate.initiate');
Route::get('/subscription/manage/{id}', [DonationController::class, 'showManageSubscription'])->name('subscription.manage');
Route::post('/subscription/cancel/{id}', [DonationController::class, 'processPublicCancel'])->name('subscription.cancel');
Route::post('/razorpay/webhook', [DonationController::class, 'handleWebhook']);

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.page-content.index');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/page-content', [PageContentController::class, 'index'])->name('page-content.index');
    Route::get('/page-content/{page}/{section}', [PageContentController::class, 'edit'])->name('page-content.edit');
    Route::post('/page-content/update', [PageContentController::class, 'update'])->name('page-content.update');

    Route::get('/donations', [AdminDonationController::class, 'index'])->name('donations.index');
    Route::get('/donations/download', [AdminDonationController::class, 'download'])->name('donations.download');
    Route::get('/subscriptions', [AdminDonationController::class, 'subscriptions'])->name('subscriptions.index');
    Route::post('/subscriptions/cancel/{id}', [AdminDonationController::class, 'cancelSubscription'])->name('subscriptions.cancel');
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [AdminSettingController::class, 'update'])->name('settings.update');

    Route::get('/campaigns/delete-image/{id}', [AdminCampaignController::class, 'deleteImage'])->name('campaigns.delete-image');
    Route::resource('campaigns', AdminCampaignController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('policies', PolicyController::class);
    Route::resource('annual-reports', AnnualReportController::class);
    Route::resource('newsletters', NewsletterController::class);
    Route::resource('blog-categories', BlogCategoryController::class);
    Route::get('/blog/delete-image/{id}', [BlogPostController::class, 'deleteImage'])->name('blog.delete-image');
    Route::resource('blog', BlogPostController::class);
});
