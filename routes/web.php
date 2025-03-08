<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\IndexController;

use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('career')->group(function(){
    // Route::get('/',[CarrierController::class, 'careerPage'])->name('career.page');
    Route::get('/',[CarrierController::class, 'career'])->name('career');
    Route::get('/confirmation',[CarrierController::class, 'confirmation'])->name('confirmation');
    Route::get('/application_form/{slug}',[CarrierController::class, 'careerApplicationForm'])->name('application.form');
    Route::post('/application-form/submit',[CarrierController::class, 'ApplicationformSubmit'])->name('application.form.submit');
});

 Route::get('/extra-curricular',[IndexController::class, 'extra_curricular'])->name('extra-curricular.index');

 Route::get('/teaching-process',[IndexController::class, 'teaching_process'])->name('teaching-process.index');


 Route::get('/why-choose-us',[IndexController::class, 'why_choose_us'])->name('why-choose-us.index');

 Route::get('/faculty',[IndexController::class, 'faculty'])->name('faculty.index');



 




















Route::prefix('admin')->group(function() {
    require 'custom/admin.php';
});

