<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ForumIndexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', ForumIndexController::class)->name('home');
Route::get('/forum', ForumIndexController::class);
Route::get('/forum/{discussion:slug}', [DiscussionController::class, 'show'])->name('discussion.show');
Route::post('/markdown', MarkdownController::class)->name('markdown');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Discussion
    Route::post('/forum', [DiscussionController::class, 'store'])->name('discussion.store');
    Route::delete('/forum/discussion/{discussion}', [DiscussionController::class, 'destroy'])->name('discussion.destroy');
    Route::patch('/forum/{discussion}/solution', [DiscussionController::class, 'solution'])->name('discussion.solution.patch');

    Route::post('/forum/{discussion:slug}', [PostController::class, 'store'])->name('post.store');
    Route::patch('/forum/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/forum/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});

require __DIR__.'/auth.php';