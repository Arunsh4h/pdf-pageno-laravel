<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfNumberingController;
use App\Http\Controllers\UploadController;
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
 
Route::get('/pdf-page-numbering', [PdfNumberingController::class, 'index']);

Route::get('/multiuploads', [UploadController::class, 'uploadForm']);
Route::post('/multiuploads', [UploadController::class, 'uploadSubmit']);


//Route::get('/multiuploads', 'UploadController@uploadForm');
//Route::post('/multiuploads', 'UploadController@uploadSubmit');