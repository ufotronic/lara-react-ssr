<?php

use App\Enum\PermissionsEnum;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UpvoteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::redirect('/', '/dashboard');

/*Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['verified'])-> group(function () {

        Route::get('/dashboard', function () {

            return Inertia::render('Dashboard');

        })->name('dashboard');

/*        Route::get('/feature', [FeatureController::class, 'index'])
            ->name('feature.index');*/

        // php artisan route:list; this creates all routes
         Route::resource('feature', FeatureController::class)
             ->except(['index','show'])
             ->middleware('can:' . PermissionsEnum::ManageFeatures->value);

         Route::get('/feature', [FeatureController::class, 'index'])
             ->name('feature.index');

        Route::get('/feature/{feature}', [FeatureController::class, 'show'])
            ->name('feature.show');

         Route::post('/feature/{feature}/upvote', [UpvoteController::class, 'store'])
             -> name('upvote.store');

        Route::delete('/upvote/{feature}', [UpvoteController::class, 'destroy'])
            -> name('upvote.destroy');


        Route::post('/feature/{feature}/comments', [CommentController::class, 'store'])
            -> name('comment.store')
            -> middleware('can:' . PermissionsEnum::ManageComments->value);

        Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])
            -> name('comment.destroy')
            -> middleware('can:' . PermissionsEnum::ManageComments->value);



    });
});

require __DIR__.'/auth.php';
