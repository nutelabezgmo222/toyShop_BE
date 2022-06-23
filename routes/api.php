<?php

use App\Models\Post;

use App\Http\Controllers\ToyApiController;
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

Route::get('/toys', [ToyApiController::class, 'index']);

Route::post('/toys', [ToyApiController::class, '_POST']);

// Route::put('/posts/{post}', function(Post $post) {

//     return $post->update([
//         'title' => $bodyContent['title'],
//         'content' => $bodyContent['content'],
//     ]);
// });