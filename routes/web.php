<?php

use App\Http\Controllers\Admin\AgeController;
use App\Http\Controllers\Admin\AuthControlller;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ProfessionController;
use App\Http\Controllers\Admin\paymentModeController;
use App\Http\Controllers\User\Api\AngelOneController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Route Here 
Route::controller(AuthControlller::class)->prefix('admin')->group(function(){
    Route::get('login', 'index');
    Route::post('login', 'login')->name('admin.login');
    Route::get('profile', 'profile')->name('profile');
});
Route::controller(AngelOneController::class)->group(function(){
    Route::get('angel-one', 'angelOneLogin');
});

Route::middleware('admin')->group(function(){
    Route::controller(IndexController::class)->prefix('admin')->group(function(){
        Route::get('dashboard', 'index')->name('admin.dashboard');
        Route::get('users', 'users')->name('all.users');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::controller(ProfessionController::class)->prefix('admin')->group(function(){
        Route::get('professions', 'index')->name('professions');
        Route::get('profession/add', 'store')->name('store.profession');
        Route::post('profession', 'create')->name('create.profession');
        Route::get('profession/edit/{id}', 'edit')->name('edit.profession');
        Route::post('update/{id}', 'update')->name('update.profession');
        Route::get('profession/delete/{id}', 'delete')->name('delete.profession');
    });
    
    Route::controller(IncomeController::class)->prefix('admin')->group(function(){
        Route::get('income', 'index')->name('income');
        Route::get('income/add', 'store')->name('store.income');
        Route::post('income/add', 'create')->name('create.income');
        Route::get('income_range/edit/{id}', 'edit')->name('edit.income_range');
        Route::post('income_range/update/{id}', 'update')->name('update.income.range');
        Route::get('income_range/delete/{id}', 'delete')->name('delete.income.range');
    });

    Route::controller(AgeController::class)->prefix('admin')->group(function(){
        Route::get('age', 'index')->name('age');
        Route::get('age/add', 'store')->name('store.age');
        Route::post('age/add', 'create')->name('create.age');
        Route::get('age/edit/{id}', 'edit')->name('edit.age');
        Route::post('age/update/{id}', 'update')->name('update.age');
        Route::get('age/delete/{id}', 'delete')->name('delete.age');
    });

    Route::controller(PlanController::class)->prefix('admin')->group(function(){
        Route::get('plan', 'index')->name('plan');
        Route::get('plan/add', 'store')->name('store.plan');
        Route::post('plan/add', 'create')->name('create.plan');
    });

    Route::controller(paymentModeController::class)->prefix('admin')->group(function(){
       Route::get('payment_mode', 'index')->name('payment_mode');
       Route::get('payment_mode/add', 'store')->name('store.payment.mode');
       Route::post('payment_mode', 'create')->name('create.payment.mode');
       Route::get('payment_mode/edit/{id}', 'edit')->name('edit.mode');
       Route::post('payment_mode/update/{id}', 'update')->name('update.payment.mode');
       Route::get('payment_mode/delete/{id}', 'delete')->name('delete.mode');
    });
});