<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserCarController;

Route::get('/', [UserCarController::class, 'index'])->name('home');
Route::get('/search', [UserCarController::class, 'search'])->name('search');

Route::get('/get-users-by-group', [UserCarController::class, 'getUsersByGroup'])->name('get.users.by.group');

Route::get('/add-user', [UserCarController::class, 'showAddUserForm'])->name('add.user.form');
Route::post('/add-user', [UserCarController::class, 'storeUser'])->name('add.user');

Route::get('/add-car', [UserCarController::class, 'showAddCarForm'])->name('add.car.form');
Route::post('/add-car', [UserCarController::class, 'storeCar'])->name('add.car');

Route::get('/add-group', [UserCarController::class, 'showAddGroupForm'])->name('add.group.form');
Route::post('/add-group', [UserCarController::class, 'storeGroup'])->name('add.group');
