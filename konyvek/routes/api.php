<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/users', UserController::class);
Route::apiResource('/copies', CopyController::class);
Route::apiResource('/books', BookController::class);

Route::get('/lendings', [LendingController::class, 'index']);
Route::get('/lendings/{user_id}/{copy_id}/{start}', [LendingController::class, 'show']);
//Route::put('/lendings/{user_id}/{copy_id}/{start}', [LendingController::class, 'update']);
Route::post('/lendings', [LendingController::class, 'store']);
Route::delete('/lendings/{user_id}/{copy_id}/{start}', [LendingController::class, 'destroy']);

Route::middleware('auth.basic')->group(function () {
    Route::apiResource('/users', UserController::class);
    //Lekérdezések with
    Route::get('/lending_by_user', [UserController::class,'lendingByUser']);
    Route::get('/all_lending', [LendingController::class, 'allLendingUserCopy']);
    Route::get('/book_lending', [LendingController::class, 'allLendingBookCopy']);
    Route::get('/where_lending/{myDate}', [LendingController::class, 'lendingsOnDate']);
    Route::get('/copies_lending/{copyid}', [LendingController::class, 'coppiesOnDate']);
    //DB lekérdezések
    Route::get('/title_count/{konyv}',[BookController::class,'titleCount']);
    Route::get('/h_author_count',[CopyController::class,'hAuthorTitle']);
    Route::get('/year_books/{publication}',[CopyController::class,'ev']);
});
