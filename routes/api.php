<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
// use App\Http\Controllers\PageController;
// use App\Http\Controllers\LinkController;
// use App\Http\Controllers\TypeController;
// use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookmarkController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user/all', [UserController::class, 'getAllUsers']);
    Route::get('/user/one', [UserController::class, 'getOneUser']);
    Route::get('/user/delete', [UserController::class, 'deleteUser']);
    Route::get('/user/update', [UserController::class, 'updateUser']);

    Route::get('/article/all', [ArticleController::class, 'getAllArticles']);
    Route::get('/article/one', [ArticleController::class, 'getOneArticle']);
    Route::get('/article/name', [ArticleController::class, 'getArticlesByName']);
    Route::get('/article/delete', [ArticleController::class, 'deleteArticle']);
    Route::get('/article/user', [ArticleController::class, 'userArticlesCount']);
    Route::post('/article/create', [ArticleController::class, 'createArticle']);
  
    Route::post('/bookmark', [BookmarkController::class, 'bookmark']);
    Route::post('/unbookmark', [BookmarkController::class, 'unbookmark']);
    Route::get('/bookmarked', [BookmarkController::class, 'isBookmarked']);
    Route::get('/bookmarked/user/articles', [BookmarkController::class, 'getUserBookmarks']);
});
