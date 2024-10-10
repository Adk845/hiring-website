<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PipelineController;
use App\Http\Controllers\VacancyController;
use App\Models\Applicant;
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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
Route::resource('jobs', \App\Http\Controllers\JobController::class)->middleware('auth');
Route::resource('departements', DepartementController::class)->middleware('auth');
Route::resource('pipelines', ApplicantController::class)->middleware('auth');
Route::get('pipelines', [ApplicantController::class, 'index'])->name('pipelines.index')->middleware('auth');
Route::put('pipelines/{id}/updateStatus', [ApplicantController::class, 'updateStatus'])->name('applicants.updateStatus')->middleware('auth');
Route::get('/pipelines/{id}/pdf', [ApplicantController::class, 'generatePdf'])->name('applicants.generatePdf')->middleware('auth');

Route::delete('/pipelines/{applicant}', [ApplicantController::class, 'destroy'])->name('pipelines.destroy');
Route::get('/get-jurusan/{education_id}', [ApplicantController::class, 'getJurusan']);

// Route::resource('pipelines', PipelineController::class);

Route::post('/test', [VacancyController::class, 'test'])->name('test');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::patch('/jobs/{job}/update-status', [JobController::class, 'updateStatus'])->name('jobs.updateStatus');
Route::get('/list', [VacancyController::class, 'list'])->name('vacancy_list');
Route::get('/form/{id}', [VacancyController::class, 'form'])->name('vacancy_form');
Route::post('/kirim', [VacancyController::class, 'kirim'])->name('kirim');
Route::get('/{id}', [App\Http\Controllers\VacancyController::class, 'index'])->name('vacancy');
