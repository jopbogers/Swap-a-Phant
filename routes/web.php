<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\CollectionOverview;
use App\Livewire\ElephantOverview;
use App\Livewire\TradeCenter;
use App\Livewire\TradeCollection;
use Illuminate\Support\Facades\Route;

Route::get('/', ElephantOverview::class)->name('elephants');

Route::middleware('auth')->group(function () {
    Route::get('/collection', CollectionOverview::class)->name('collection');
    Route::get('/trade', TradeCenter::class)->name('trades');
    Route::get('/trade/{collectionId}', TradeCollection::class)->name('trade-collection');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
