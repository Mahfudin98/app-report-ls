<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\SuperAdmin\PositionController;
use App\Http\Controllers\Api\SuperAdmin\ProductController;
use App\Http\Controllers\Api\SuperAdmin\RolePermissionController;
use App\Http\Controllers\Api\SuperAdmin\UserController;
use App\Http\Controllers\Api\User\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::group(['middleware' => 'auth:sanctum'], function () {
    // cs report
    Route::get('/cs-reports', [ReportController::class, 'indexCS'])->name('index.report.cs');
    Route::post('/cs-reports', [ReportController::class, 'storeCS'])->name('store.report.cs');
    // adv report
    Route::get('/adv-reports', [ReportController::class, 'indexADV'])->name('index.report.adv');
    // superadmin
    Route::resource('/positions', PositionController::class)->except(['show', 'create']);
    Route::resource('/products', ProductController::class)->except(['show']);
    Route::resource('/teams', UserController::class)->except(['create', 'show']);
    Route::get('/teams/{slug}', [UserController::class, 'show'])->name('teams.show.slug');

    // permissions
    Route::get('roles', [RolePermissionController::class, 'getAllRole'])->name('roles');
    Route::get('permissions', [RolePermissionController::class, 'getAllPermission'])->name('permission');
    Route::post('role-permission', [RolePermissionController::class, 'getRolePermission'])->name('role_permission');
    Route::post('set-role-permission', [RolePermissionController::class, 'setRolePermission'])->name('set_role_permission');
    Route::post('set-role-user', [RolePermissionController::class, 'setRoleUser'])->name('user.set_role');
    Route::get('/get-adv', [UserController::class, 'getAdv'])->name('get.adv');
    // get auth
    Route::get('user-authenticated', [LoginController::class, 'getUserLogin'])->name('user.authenticated');
    Route::get('user-lists', [LoginController::class, 'userLists'])->name('user.index');
});
