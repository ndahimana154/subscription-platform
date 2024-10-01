<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PostNotificationController;



Route::get('/websites', [WebsiteController::class, 'index']);
Route::post('/websites', [WebsiteController::class, 'store']);
Route::get('/websites/{website}', [WebsiteController::class, 'show']);
Route::put('/websites/{website}', [WebsiteController::class, 'update']);
Route::delete('/websites/{website}', [WebsiteController::class, 'destroy']);


Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/websites/{website}/posts', [PostController::class, 'index']);


Route::get('/subscriptions', [SubscriptionController::class, 'index']); 
Route::post('/subscriptions', [SubscriptionController::class, 'store']); 
Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show']);
Route::put('/subscriptions/{subscription}', [SubscriptionController::class, 'update']); 
Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy']); 


Route::post('/notify-subscribers/{postId}', [PostNotificationController::class, 'notifySubscribers']);
