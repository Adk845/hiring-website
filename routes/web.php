<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PipelineController;
use App\Http\Controllers\VacancyController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::resource('jobs', \App\Http\Controllers\JobController::class)->middleware('auth');
Route::resource('departements', DepartementController::class);
Route::resource('pipelines', ApplicantController::class);
Route::get('applicants', [ApplicantController::class, 'index'])->name('pipelines.index');
Route::put('/applicants/{id}/updateStatus', [ApplicantController::class, 'updateStatus'])->name('applicants.updateStatus');
Route::get('/pipelines/{id}/pdf', [ApplicantController::class, 'generatePdf'])->name('applicants.generatePdf');

Route::delete('/pipelines/{applicant}', [ApplicantController::class, 'destroy'])->name('pipelines.destroy');

// Route::resource('pipelines', PipelineController::class);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::patch('/jobs/{job}/update-status', [JobController::class, 'updateStatus'])->name('jobs.updateStatus');
Route::get('/list', [VacancyController::class, 'list'])->name('vacancy_list');
Route::get('/form/{id}', [VacancyController::class, 'form'])->name('vacancy_form');
Route::get('/{id}', [App\Http\Controllers\VacancyController::class, 'index'])->name('vacancy');
