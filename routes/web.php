<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CampaignController;

use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.page-content.index');
    });

    Route::get('/page-content', [PageContentController::class, 'index'])->name('page-content.index');
    Route::get('/page-content/{page}/{section}', [PageContentController::class, 'edit'])->name('page-content.edit');
    Route::post('/page-content/update', [PageContentController::class, 'update'])->name('page-content.update');

    Route::resource('campaigns', AdminCampaignController::class);
});

