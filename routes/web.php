<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Components\Sidebar;
use App\Livewire\Explore;
use App\Livewire\Home;
use App\Livewire\Notifications;
use App\Livewire\Post\View\Page;
use App\Livewire\Profile\Home as ProfileHome;
use App\Livewire\Profile\Reels;
use App\Livewire\Profile\Saved;
use App\Livewire\Reels as LivewireReels;
use Illuminate\Support\Facades\Route;

Route::get('/',Home::class)->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{user}',ProfileHome::class)->name('profile.home');
    Route::get('/profile/{user}/reels',Reels::class)->name('profile.reels');
    Route::get('/profile/{user}/saved',Saved::class)->name('profile.saved');

    Route::get('/',Home::class);
    Route::get('/explore',Explore::class)->name('explore');
    Route::get('/reels',LivewireReels::class)->name('reels');
    Route::get('/notifications/{user}',Notifications::class)->name('notifications');

    Route::get('/post/{post}',Page::class)->name('post');


});

require __DIR__.'/auth.php';
