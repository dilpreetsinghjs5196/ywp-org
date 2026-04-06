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

use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
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
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
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
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [AdminSettingController::class, 'update'])->name('settings.update');

    Route::get('/campaigns/delete-image/{id}', [AdminCampaignController::class, 'deleteImage'])->name('campaigns.delete-image');
    Route::resource('campaigns', AdminCampaignController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('policies', PolicyController::class);
    Route::resource('annual-reports', AnnualReportController::class);
    Route::resource('newsletters', NewsletterController::class);
});
