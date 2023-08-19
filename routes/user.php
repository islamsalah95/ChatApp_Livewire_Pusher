<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FriendShipController;

Route::middleware('guest')->group(function () {

});

Route::middleware('auth')->group(function () {

    Route::group(['prefix' => 'friendships', 'as' => 'friendships.'], function () {
        Route::get('/', [FriendShipController::class, 'index'])->name('index');
        Route::get('create', [FriendShipController::class, 'create'])->name('create');
        Route::get('{friend_ship}/edit', [FriendShipController::class, 'edit'])->name('edit');
        Route::post('destroy/{friend_ship}', [FriendShipController::class, 'destroy'])->name('destroy');
        // Route::post('destroyFriendUser/{user}', [FriendShipController::class, 'destroyFriendUser'])->name('destroyFriendUser');

        Route::post('update/{friend_ship}', [FriendShipController::class, 'update'])->name('update');
    
    });

    Route::post('store/{user}', [FriendShipController::class, 'store'])->name('friendships.store');



Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
    Route::get('/', [MessageController::class, 'index'])->name('index');
    Route::get('create', [MessageController::class, 'create'])->name('create');
    Route::post('/', [MessageController::class, 'store'])->name('store');
    Route::get('{message}', [MessageController::class, 'show'])->name('show');
    Route::get('{message}/edit', [MessageController::class, 'edit'])->name('edit');
    Route::put('{message}', [MessageController::class, 'update'])->name('update');
    Route::delete('{message}', [MessageController::class, 'destroy'])->name('destroy');
});


Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('/', [UsersController::class, 'index'])->name('index');   
});


});
