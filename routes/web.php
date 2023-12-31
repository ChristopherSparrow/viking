<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;
use App\http\Controllers\CompetitionController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\StandingController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|


Route::get('/',[SeasonController::class, 'index']);
Route::get('/season',[SeasonController::class, 'index']);
Route::get('/seasons/{season}', [SeasonController::class, 'show']);
*/



Route::get('/', [HomepageController::class, 'index'])->name('homepage.index');

Route::resource('/seasons', SeasonController::class);
Route::resource('/competitions', CompetitionController::class);
Route::resource('/fixtures', FixtureController::class);
Route::get('/standings', [StandingController::class, 'standings'])->name('badger');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
/*
require __DIR__.'/auth.php';   */