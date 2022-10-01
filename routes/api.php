<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
 *
 So here is the test.
1. Set up a Laravel project
2. Implement Apis for login and signup
3. Should be able to login with either phone number or email
4. Implement an Api that list all signed up users
5. Your app should be connected to a database so that it can store real data
6. When you are done, package it and send it to me. I should be able to run your app on my own laptop and it should work without me having to edit your code.
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

Route::post('/signup', [UserController::class, 'store'])
    ->name('signup');

Route::post('/login', [UserController::class, 'index'])
    ->name('login');

Route::get('/users', [UserController::class, 'show'])
    ->name('show');

