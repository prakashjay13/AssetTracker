<?php

use App\Http\Controllers\ImagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetTypeController;
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
    return view('auth.login');
});
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/table', function () {
    return view('PieChart');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/AssetType', [AssetTypeController::class, "ShowAssetType"])->name('ShowAssetType');
Route::post('/InsertAssetType', [AssetTypeController::class, "InsertAssetType"])->name('InsertAssetType');
Route::get('/AssetType', [AssetTypeController::class, 'AssetType'])->name('AssetType');
Route::get('/EditAssetType/{id}', [AssetTypeController::class, 'EditAssetType'])->name('EditAssetType');
Route::post('/UpdateAssetType', [AssetTypeController::class, 'UpdateAssetType'])->name('UpdateAssetType');
Route::get('/DeleteAssetType/{id}', [AssetTypeController::class, 'DeleteAssetType'])->name('DeleteAssetType');

Route::get('/AddAssets', [AssetController::class, 'Assets'])->name('AddAsset');
Route::get('/Assets', [AssetController::class, 'ShowAssets'])->name('ShowAssets');
Route::post('/InsertAssets', [AssetController::class, 'InsertAssets'])->name('InsertAssets');
Route::get('/EditAssets/{id}', [AssetController::class, 'EditAssets'])->name('EditAssets');
Route::post('/UpdateAssets', [AssetController::class, 'UpdateAssets'])->name('UpdateAssets');
Route::get('/DeleteAssets/{id}', [AssetController::class, 'DeleteAssets'])->name('DeleteAssets');

Route::get('/ImageShow/{id}', [ImagesController::class, 'ImageShow'])->name('ImageShow');
Route::post('/UploadImage', [ImagesController::class, 'UploadImage'])->name('UploadImage');
Route::get('/ShowImage/{id}', [ImagesController::class, 'ShowImage'])->name('ShowImage');


Route::get('/BarChart', [AssetTypeController::class, 'BarChart'])->name('BarChart');
Route::get('/PieChart', [AssetTypeController::class, 'PieChart'])->name('PieChart');
