<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\FileUploadController;
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
Route::group(['middleware' => ['auth', 'superadmin']],
              function(){
                Route::get('/demande/{notification?}', [DemandeController::class, 'superadminDemandes'])->name('superadmin_demandes');
                Route::post('/demande_realisee/{demande_id}/{user_id}', [DemandeController::class, 'marquerDemandeRealisee']);

});


Route::group(['middleware' => ['auth', 'admin']],
              function(){
                Route::get('/users', 'UserController@index')->name('users');

                Route::get('/create_user', 'UserController@create')->name('create_user');
                Route::post('/create_user', 'UserController@store')->name('create_user');

                Route::get('/edit_user/{id}', [UserController::class, 'edit'])->name('edit_user');
                Route::post('/edit_user/{id}', [UserController::class, 'update'])->name('edit_user');

                Route::post('/delete_user/{id}', [UserController::class, 'destroy']);

                Route::get('/services', [ServiceController::class, 'index'])->name('services');
                
                Route::get('/add_service', [ServiceController::class, 'create'])->name('add_service');
                Route::post('/add_service', [ServiceController::class, 'store'])->name('add_service');

                Route::get('/edit_service/{id}', [ServiceController::class, 'edit'])->name('edit_service');
                Route::post('/edit_service/{id}', [ServiceController::class, 'update'])->name('edit_service');            
                          
                Route::post('/delete_service/{id}', [ServiceController::class, 'destroy']);
                
                Route::get('/demandes_admin/{id?}', [DemandeController::class, 'getGestionDemandes'])->name('demandes_admin');
                Route::post('/demandes_admin', [DemandeController::class, 'postGestionDemandes']);
                Route::post('/delete_demande/{id}', [DemandeController::class, 'destroy']);

                // returns the candidatures view
                Route::get('cv_upload', [FileUploadController::class, 'cvUpload'])->name('CV_upload');

                // returns Json response 
                Route::get('cvs_display', [FileUploadController::class, 'displayCvs'])->name('cv_display');
                
                // telecharger un cv dans le serveur
                Route::post('cv_upload', [FileUploadController::class, 'cvUploadPost'])->name('CV_upload_post');

                Route::get('/cv_pdf/{cv_emplacement}',function($cv_emplacement) {
                  return view('admin.cv_pdf_file')->with('cv_emplacement',$cv_emplacement);
                });

                Route::get('/cv_img/{cv_emplacement}',function($cv_emplacement) {
                  return view('admin.cv_img_file',compact('cv_emplacement'));
                });

                Route::delete('/delete_cv/{file_name}','FileUploadController@deleteCV');
                
                
                
});


Auth::routes(['register' => false]);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');



Route::get('/', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@index')->name('home');

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'authenticate']);

Route::get('profile', [UserController::class, 'profile'])->name('profile');
Route::get('/demandes/{notification?}', [DemandeController::class, 'getDemandesForm'])->name('demandes');
Route::post('/demandes', [DemandeController::class, 'effectuerDemande']);


/**
 * Regular users changing their passwords
 */
Route::get('/update_password_form', 'UserController@updatePasswordForm');
Route::post('/update_password', 
            'UserController@updatePassword')
            ->middleware('auth')
            ->name('reset_pass');
