<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserRole;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LabelSettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    
    Route::middleware([CheckUserRole::class . ':admin'])->group(function () {

        Route::get('/dashboard/{status?}', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
        Route::resource('users', UserController::class)->only(['index','update','destroy']);
        Route::resource('clients', ClientController::class)->only(['index', 'update', 'store', 'destroy', 'edit', 'create']);
        Route::resource('workers', WorkerController::class)->only(['index', 'update', 'store', 'destroy', 'create', 'edit']);
        Route::resource('jobs', JobController::class)->only(['index', 'update', 'store', 'destroy', 'create', 'edit']);
        Route::resource('message', MessageController::class)->only(['index', 'update', 'store', 'destroy', 'create', 'edit']);
        Route::resource('status', StatusController::class)->only(['index', 'update', 'store', 'destroy', 'create', 'edit']);
        Route::get('/workers/{worker}/jobs/{status}', 'App\Http\Controllers\WorkerJobsController@showJobs')->name('worker.jobs');
        Route::get('/job/{job_id}/print', 'App\Http\Controllers\JobController@printJob')->name('job.print');
        Route::resource('label-settings', LabelSettingsController::class)->only(['index', 'update', 'store', 'destroy', 'create', 'edit']);
    });
    Route::middleware([CheckUserRole::class . ':staff'])->group(function () {
        Route::get('/dashboard/{status?}', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
        Route::resource('clients', ClientController::class)->only(['index', 'update', 'store', 'edit', 'create']);
        Route::resource('jobs', JobController::class)->only(['index', 'update', 'store', 'create', 'edit']);
        Route::resource('message', MessageController::class)->only(['index', 'update', 'store', 'create']);
        Route::resource('label-settings', LabelSettingsController::class)->only(['index', 'update', 'store', 'destroy', 'create', 'edit']);
        Route::get('/workers/{worker}/jobs/{status}', 'App\Http\Controllers\WorkerJobsController@showJobs')->name('worker.jobs');
        Route::get('/job/{job_id}/print', 'App\Http\Controllers\JobController@printJob')->name('job.print');
    });
});
