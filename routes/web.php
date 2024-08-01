<?php

use App\Http\Controllers\FolderController;
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

Route::view('/','welcome');


Route::post('/user/register' ,   [App\Http\Controllers\Auth\RegisterController::class,'create']);
Route::get('user/logout' , [App\Http\Controllers\Auth\LoginController::class,'logout']);

Route::middleware(['auth'])->group(function () {
	Route::prefix('dashboard')->group(function () {
		Route::get('/', [App\Http\Controllers\DashboardController::class,'index']);
		Route::middleware(['role:0'])->group(function () {
		});
	});
});

Auth::routes();
Route::prefix('dashboard')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
	/* Employees Routes */
	Route::get('/employee'				 		,	[App\Http\Controllers\EmployeesController::class,'index']);
	Route::get('employee/single-employee/{id?}'	,   [App\Http\Controllers\EmployeesController::class,'index2']);
	Route::get('/employee/create'  			    ,	[App\Http\Controllers\EmployeesController::class,'create']);
	Route::post('employee/create'  		 	    ,	[App\Http\Controllers\EmployeesController::class,'create']);
	Route::get('/employee/update/{id?}'  		,	[App\Http\Controllers\EmployeesController::class,'edit']);
	Route::post('employee/update/{id?}' 		,	[App\Http\Controllers\EmployeesController::class,'edit']);
	Route::get('employee/delete/{id?}'			,	[App\Http\Controllers\EmployeesController::class,'delete']);
	Route::get('modal/employee/updatepassword'  ,	[App\Http\Controllers\EmployeesController::class,'updatePassword']);
	Route::post('employee/updatepassword'       ,	[App\Http\Controllers\EmployeesController::class,'updatePassword']);
    Route::get('employee/profile'               ,   [App\Http\Controllers\EmployeesController::class,'profile'])->name('employee.profile');


   /*Upload Document routes */
    Route::post('document/upload'            , [App\Http\Controllers\UploadDocumentController::class, 'upload'])->name('upload');
    Route::get('document'                    , [App\Http\Controllers\UploadDocumentController::class, 'index'])->name('show');
    Route::get('document/delete/{ids}'       , [App\Http\Controllers\UploadDocumentController::class, 'destroy'])->name('delete');
    Route::get('document/download-file/{ids}', [App\Http\Controllers\UploadDocumentController::class, 'downloadZip'])->name('download');
    Route::post('document/rename'            , [App\Http\Controllers\UploadDocumentController::class, 'rename'])->name('rename');
    Route::post('/document/files'            , [App\Http\Controllers\UploadDocumentController::class,'fetchFiles'])->name('document.files');
    Route::post('document/search'            , [App\Http\Controllers\UploadDocumentController::class, 'serchFiles']);

   /*Search Document routes */
   Route::get('document/search'              , [App\Http\Controllers\SearchDocumentController::class, 'index']);

});




