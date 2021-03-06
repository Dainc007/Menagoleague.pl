<?php

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome', [
        'articles' => Article::all()
    ]);
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/users')->group(function () {

    Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])
        ->name('user.account');

    Route::get('/{user}', [App\Http\Controllers\AccountController::class, 'show'])
        ->name('user.show');

    Route::PUT('/{id}', [App\Http\Controllers\AccountController::class, 'update'])
        ->name('account.update');

    Route::prefix('/rivals')->group(function () {

        Route::post('/invite', [App\Http\Controllers\RivalController::class, 'invite'])
            ->name('rival.invite');

        Route::post('/store/{id}', [App\Http\Controllers\RivalController::class, 'respond'])
            ->name('rival.respond');
    });
});

Route::prefix('/teams')->group(function () {

    Route::get('/', [App\Http\Controllers\TeamController::class, 'index'])
        ->name('team');

    Route::get('/{team}', [App\Http\Controllers\TeamController::class, 'show'])
        ->name('teams.show');
});

Route::prefix('/transfers')->group(function () {

    Route::get('/', [App\Http\Controllers\TransferController::class, 'index'])
        ->name('transfers');
});

Route::prefix('/office')->group(function () {

    Route::get('/', [App\Http\Controllers\OfficeController::class, 'index'])
        ->name('office');
});

Route::prefix('/seasons')->group(function () {

    Route::get('/', [App\Http\Controllers\SeasonController::class, 'index'])
        ->name('season');
});

Route::prefix('/players')->group(function () {

    Route::get('/{player}', [App\Http\Controllers\PlayerController::class, 'show'])
        ->name('players.show');
});

Route::prefix('/articles')->group(function () {

    Route::get('/create', [App\Http\Controllers\ArticleController::class, 'create'])
        ->name('article.create')->middleware('administrator');

    Route::get('/{article}', [App\Http\Controllers\ArticleController::class, 'show'])
        ->name('article.show');

    Route::PUT('/{article}', [App\Http\Controllers\ArticleController::class, 'edit'])
        ->name('article.edit')->middleware('administrator');

    Route::POST('/store', [App\Http\Controllers\ArticleController::class, 'store'])
        ->name('article.store')->middleware('administrator');

    Route::DELETE('/{article}', [App\Http\Controllers\ArticleController::class, 'delete'])
        ->name('article.delete')->middleware('administrator');
});

Route::prefix('/admin')->group(function () {

    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])
        ->name('admin.index');
});

Route::prefix('/leagues')->group(function () {

    Route::get('/{league}', [App\Http\Controllers\LeagueController::class, 'show'])
        ->name('league.show');
});

Route::prefix('/competitions')->group(function () {

    Route::get('/', [App\Http\Controllers\CompetitionController::class, 'index'])
        ->name('competition.index');

    Route::get('/create', [App\Http\Controllers\CompetitionController::class, 'create'])
        ->name('competition.create')->middleware('administrator');

    Route::get('/{competition}', [App\Http\Controllers\CompetitionController::class, 'show'])
        ->name('competition.show');

    Route::post('/store', [App\Http\Controllers\CompetitionController::class, 'store'])
        ->name('competition.store');

    Route::prefix('/fixtures')->group(function () {

        Route::get('/create/{competition}', [App\Http\Controllers\FixtureController::class, 'create'])
            ->name('fixture.create');

        Route::post('/store/{competition}', [App\Http\Controllers\FixtureController::class, 'store'])
            ->name('fixture.store');
    });

    Route::prefix('/tutorial')->group(function () {

        Route::post('/invite', [App\Http\Controllers\TutorialController::class, 'invite'])
            ->name('tutorial.invite');
    });
});
