<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\PostController;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/post/comments/{post_id}', [PostController::class, 'getComments']);
Route::post('/post/comment/{post_id}', [PostController::class, 'comment']);


Route::group(['prefix' => 'admin', 'middleware' => 'auth:admins'], function () {
    Route::post('/post', [PostController::class, 'store']);
});

Route::get('/test', function () {
    return response([
        'message' => 'Blog Api',
    ]);
});

Route::post('/login', [AdminController::class, 'login']);
