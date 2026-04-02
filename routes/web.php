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

Route::get('/', [HomeController::class, 'index']);
Route::get('/our-mission', [HomeController::class, 'ourMission'])->name('our-mission');
Route::get('/history', [HomeController::class, 'history'])->name('history');
Route::get('/advisory-board', [HomeController::class, 'advisoryBoard'])->name('advisory-board');
Route::get('/on-board-professionals', [HomeController::class, 'professionals'])->name('on-board-professionals');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/research-papers', [HomeController::class, 'researchPapers'])->name('research-papers');
Route::get('/policies', [HomeController::class, 'policies'])->name('policies');
Route::get('/reports', [HomeController::class, 'reports'])->name('reports');
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');

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

    Route::resource('campaigns', AdminCampaignController::class);
    Route::resource('professionals', ProfessionalController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('policies', PolicyController::class);
    Route::resource('annual-reports', AnnualReportController::class);
});
