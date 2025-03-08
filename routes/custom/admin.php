
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ExtraCurricularController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\TeachingController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;


Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/addmission/form',[AdminController::class, 'addmissionform'])->name('admission.form');
Route::post('/addmission/form/submit',[AdminController::class, 'formsubmit'])->name('form.submit');
Route::get('/addmission/list',[AdminController::class, 'admissionlist'])->name('admission_list');

Route::get('/addmission/form/edit{id}',[AdminController::class, 'editForm'])->name('edit.form');
Route::put('/addmission/form/update{id}',[AdminController::class, 'updateForm'])->name('update.form');
Route::delete('/addmission/form/delete{id}',[AdminController::class, 'deleteForm'])->name('delete.form');


Route::prefix('career')->group(function(){
    Route::prefix('post')->group(function(){
        Route::get('/list',[CareerController::class, 'postList'])->name('post.list');
        Route::get('/create',[CareerController::class, 'createForm'])->name('create.form');
        Route::post('/store',[CareerController::class, 'storeList'])->name('store.list');

        Route::get('/edit{id}',[CareerController::class, 'formEdit'])->name('form.edit');
        Route::put('/update{id}',[CareerController::class, 'updateEdit'])->name('update.edit');
        Route::delete('/delete{id}',[CareerController::class, 'deleteEdit'])->name('delete.edit');
        Route::post('/change-status',[CareerController::class, 'changePostStatus'])->name('career.change-status');
    });


    Route::prefix('unit')->group(function(){
        Route::get('/list',[UnitController::class,'unitList'])->name('unit.list');
        Route::get('/create',[UnitController::class,'createUnit'])->name('create.unit');
        Route::post('/store',[UnitController::class,'storeUnit'])->name('store.unit');

        Route::get('/edit{id}',[UnitController::class, 'editUnit'])->name('unit.edit');
        Route::put('/store/{id}',[UnitController::class, 'editStore'])->name('unit.store');
        Route::delete('/delete{id}',[UnitController::class, 'deleteUnit'])->name('unit.delete');
        Route::post('/toggle-status',[UnitController::class, 'toggleStatus'])->name('unit.toggle-status');
       
    });

    Route::prefix('subject')->group(function(){
        Route::get('/list',[SubjectController::class,'subList'])->name('sub.list');
        Route::get('/create',[SubjectController::class,'createSub'])->name('create.list');
        Route::post('/store',[SubjectController::class,'storeSub'])->name('store.sub');

        Route::get('/edit/{id}', [SubjectController::class, 'editSub'])->name('edit.sub');
        Route::put('/store/{id}',[SubjectController::class,'storeEdit'])->name('sub.store');
        Route::delete('/delete{id}',[SubjectController::class,'deleteSub'])->name('delete.sub');
        Route::post('/toggle-status',[SubjectController::class, 'toggleStatus'])->name('sub.toggle-status');
    });
 
    
    Route::prefix('jobcategory')->group(function(){
        Route::get('/list',[JobCategoryController::class, 'jobList'])->name('job.list');
        Route::get('/create',[JobCategoryController::class, 'jobCreate'])->name('job.create');
        Route::post('/store',[JobCategoryController::class, 'jobStore'])->name('job.store');

        Route::get('/edit/{id}',[JobCategoryController::class, 'jobEdit'])->name('job.edit');
        Route::put('/store/{id}',[JobCategoryController::class, 'jobstoreEdit'])->name('job.store.edit');
        Route::delete('/delete/{id}',[JobCategoryController::class, 'jobDelete'])->name('job.delete');
        Route::post('/toggle-status',[JobCategoryController::class, 'toggleStatus'])->name('job.toggle-status');

    });

    Route::prefix('jobvacancy')->group(function(){
        Route::get('/list',[JobVacancyController::class, 'vacancyList'])->name('vacancy.list');
        Route::get('/create',[JobVacancyController::class, 'vacancyCreate'])->name('vacancy.create');
        Route::post('/store',[JobVacancyController::class, 'vacancyStore'])->name('vacancy.store');

        Route::get('edit/{id}',[JobVacancyController::class, 'vacancyEdit'])->name('vacancy.edit');
        Route::put('store/{id}',[JobVacancyController::class, 'vacancystoreEdit'])->name('vacancy.store.edit');
        Route::delete('delete/{id}',[JobVacancyController::class, 'vacancyDelete'])->name('vacancy.delete');
        Route::post('/toggle-status',[JobVacancyController::class, 'toggleStatus'])->name('vacancy.toggle-status');
    });

    Route::prefix('jobapplication')->group(function(){
        Route::get('/list',[JobApplicationController::class, 'applicationList'])->name('application.list');
        Route::get('/view/{id}',[JobApplicationController::class, 'viewApplication'])->name('view.application');
    });
});

Route::prefix('master-module')->group(function(){
    Route::prefix('class')->group(function(){
        Route::get('/classlist',[StudentClassController::class, 'classList'])->name('class.list');
        Route::get('/create',[StudentClassController::class, 'classCreate'])->name('class.create');
        Route::post('/store',[StudentClassController::class, 'classStore'])->name('class.store');

        Route::get('/edit/{id}',[StudentClassController::class, 'classEdit'])->name('class.edit');
        Route::put('/store/{id}',[StudentClassController::class, 'classstoreEdit'])->name('class.store.edit');
        Route::delete('delete/{id}',[StudentClassController::class, 'classDelete'])->name('class.delete');
        Route::post('/toggle-status',[StudentClassController::class, 'toggleStatus'])->name('class.toggle-status');
    });

    Route::prefix('facility')->group(function(){
        Route::get('/facilitylist',[FacilityController::class, 'facilityList'])->name('facility.list');
        Route::get('/create',[FacilityController::class, 'facilityCreate'])->name('facility.create');
        Route::post('/store',[FacilityController::class, 'facilityStore'])->name('facility.store');

        Route::get('/edit/{id}',[FacilityController::class, 'facilityEdit'])->name('facility.edit');
        // Route::put('/store/{id}',[FacilityController::class, 'facilitystoreEdit'])->name('facility.store.edit');
        Route::match(['put', 'post'], '/store/{id}', [FacilityController::class, 'facilitystoreEdit'])->name('facility.store.edit');
        Route::delete('delete/{id}',[FacilityController::class, 'facilityDelete'])->name('facility.delete');
        Route::get('/status/{id}', [FacilityController::class, 'FacilityStatus'])->name('facility.status'); 
    });

    Route::prefix('subfacility')->group(function(){
        Route::get('/subfacilitylist/{id}',[FacilityController::class, 'subfacilityList'])->name('subfacility.list');
        Route::get('/create',[FacilityController::class, 'subfacilityCreate'])->name('subfacility.create');
        Route::post('/store',[FacilityController::class, 'subfacilityStore'])->name('subfacility.store');
        Route::get('/edit/{id}',[FacilityController::class, 'subfacilityEdit'])->name('subfacility.edit');
        Route::post('/store/{id}',[FacilityController::class, 'subfacilitystoreEdit'])->name('subfacility.store.edit');
        Route::get('/delete/{id}',[FacilityController::class,'subfacilityDelete'])->name('subfacility.delete');
        route::get('/status/{id}',[FacilityController::class, 'subfacilityStatus'])->name('subfacility.status');
    });

    Route::prefix('extra-curricular')->group(function(){
        Route::get('/curricularlist',[ExtraCurricularController::class, 'curricularList'])->name('extracurricular.list');
        Route::get('/create',[ExtraCurricularController::class, 'curricularCreate'])->name('curricular.create');
        route::post('store',[ExtraCurricularController::class, 'curricularStore'])->name('curricular.store');
        Route::get('/edit/{id}',[ExtraCurricularController::class, 'curricularEdit'])->name('curricular.edit');
        Route::post('/store/{id}',[ExtraCurricularController::class, 'curricularstoreEdit'])->name('curricular.store.edit');
        Route::delete('/delete/{id}',[ExtraCurricularController::class,'curricularDelete'])->name('curricular.delete');
    });

    Route::prefix('teaching-process')->group(function(){
        Route::get('/teachinglist',[TeachingController::class, 'teachingList'])->name('teaching.list');
        Route::get('/create',[TeachingController::class, 'teachingCreate'])->name('teaching.create');
        Route::post('/store',[TeachingController::class, 'teachingStore'])->name('teaching.store');
        Route::get('/edit/{id}',[TeachingController::class, 'teachingEdit'])->name('teaching.edit');
        Route::post('/update/{id}',[TeachingController::class, 'teachingEditStore'])->name('teaching.store.edit');
        Route::get('/delete/{id}',[TeachingController::class, 'teachingDelete'])->name('teaching.delete');
        Route::get('status/{id}',[TeachingController::class, 'TeachingStatus'])->name('teaching.status');
    });

    Route::prefix('seo')->group(function(){
        Route::get('/seolist',[SeoController::class, 'SeoList'])->name('seo.list');
        Route::get('/detail/{id}',[SeoController::class, 'SeoDetail'])->name('seo.detail');
        Route::get('/edit/{id}',[SeoController::class, 'SeoEdit'])->name('seo.edit');
        Route::post('/update',[SeoController::class, 'SeoUpdate'])->name('seo.update');
    });

    Route::prefix('why-choose-us')->group(function() {
        Route::get('/', [DepartmentController::class, 'ChooseUsIndex'])->name('choose_us.list.all');
        Route::get('/create', [DepartmentController::class, 'ChooseUsCreate'])->name('choose_us.create');
        Route::post('/store', [DepartmentController::class, 'ChooseUsStore'])->name('choose_us.store');
        Route::get('/edit/{id}', [DepartmentController::class, 'ChooseUsEdit'])->name('choose_us.edit');
        Route::post('/update', [DepartmentController::class, 'ChooseUsUpdate'])->name('choose_us.update');
        Route::get('/delete/{id}', [DepartmentController::class, 'ChooseUsDelete'])->name('choose_us.delete');
        Route::get('/status/{id}', [DepartmentController::class, 'ChooseUsStatus'])->name('choose_us.status');
    });

    Route::prefix('gallery')->group(function(){
        Route::get('/', [DepartmentController::class, 'galleryIndex'])->name('gallery.list.all');
        Route::get('/create', [DepartmentController::class, 'galleryCreate'])->name('gallery.create');
        Route::post('/store', [DepartmentController::class, 'galleryStore'])->name('gallery.store');
        Route::get('/edit/{id}', [DepartmentController::class, 'galleryEdit'])->name('gallery.edit');
        Route::post('/update', [DepartmentController::class, 'galleryUpdate'])->name('gallery.update');
        Route::get('/delete/{id}', [DepartmentController::class, 'galleryDelete'])->name('gallery.delete');
    });

    Route::prefix('faculty')->group(function(){
        Route::get('/',[FacultyController::class, 'facultyIndex'])->name('faculty.list.all');
        Route::get('/create',[FacultyController::class, 'facultyCreate'])->name('faculty.create');
        Route::post('/store',[FacultyController::class, 'facultyStore'])->name('faculty.store');
        Route::get('/edit/{id}',[FacultyController::class, 'facultyEdit'])->name('faculty.edit');
        Route::post('/update',[FacultyController::class, 'facultyUpdate'])->name('faculty.update');
        Route::get('/delete/{id}',[FacultyController::class, 'facultyDelete'])->name('faculty.delete');
        Route::get('/status/{id}',[FacultyController::class, 'facultyStatus'])->name('faculty.status');
    });

});

Route::prefix('settings')->group(function(){
    Route::get('/',[DepartmentController::class, 'settings'])->name('settings.content');
    Route::post('/setting/update',[DepartmentController::class, 'settingUpdate'])->name('settings.update');
});







