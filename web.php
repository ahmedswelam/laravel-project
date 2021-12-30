<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\blog;
use App\Http\Controllers\form;
use App\Http\Controllers\studentsController;
use App\Http\Controllers\taskController;

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
    return view('welcome');
});

/*
general Route code:- 
Route::get('URLName',[ControllerName::class, 'FunctionName']);
*/


Route::get('create',[blog::class, 'create']);

Route::post('store',[blog::class, 'store']);

Route::get('display',[blog::class, 'display']);

Route::get('edit',[blog::class, 'edit']);

Route::get('update',[blog::class, 'update']);


#Student register
Route::get('students/register',[studentsController::class, 'studentsRegister']);

Route::post('students/store',[studentsController::class, 'studentsdata']);

Route::get('students',[studentsController::class, 'display']);

Route::get('students/edit/{id}',[studentsController::class, 'edit']);

Route::post('students/update',[studentsController::class, 'update']);

Route::get('students/remove/{id}', [studentsController::class, 'destroy']);

#students Login & Logout
Route::get('students/Login', [studentsController::class, 'Login']);
Route::post('students/DoLogin', [studentsController::class, 'DoLogin']);
Route::get('students/logout', [studentsController::class, 'logout']);






/*
//Route for form
Route::get('form/register',[form::class, 'formview']);

Route::post('form/storedata',[form::class, 'storedata']);
*/



//TODO List Application

/*Create a  simple todo list application that takes tasks submitted by user in a form and saves them in database. 
The tasks are also retrieved from the database and displayed on the web page. 

* Task Fields ['title','description','startdate','enddate', image]


Note  : 
- user must register in app then login to his Account.
- each user can show only his own tasks.
- user can't edit or delete expired tasks.
- must use middlewares.
- must use resources controller.

*
   /url key           (get)    =    Route::get('Blog',[blogController::class, 'index']);
   /url key/create    (get)    =    Route::get('Blog/create',[blogController::class, 'create']);
   /url key           (post)   =    Route::post('Blog',[blogController::class, 'store']);
   /url key/{id}/edit (get)    =    Route::get('Blog/{id}/edit',[blogController::class, 'edit']);
   /url key/{id}      (put)    =    Route::put('Blog/{id}',[blogController::class, 'update']);
   /url key/{id}      (delete) =    Route::delete('Blog/{id}',[blogController::class, 'destroy']);
   /url key/{id}      (get)    =    Route::get('Blog/{id}',[blogController::class, 'show']);
*/


Route::resource('tasks', taskController::class)->middleware('LoginAuth');
Route::get('login', [taskController::class, 'login']);
Route::post('DoLogin', [taskController::class, 'DoLogin']);


//Route::get('purchase_detauls/newFunction', Purchase_detailsController@newFunction');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
