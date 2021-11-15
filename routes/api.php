<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\SuperAdmin\PositionController;
use App\Http\Controllers\Api\SuperAdmin\ProductController;
use App\Http\Controllers\Api\SuperAdmin\RolePermissionController;
use App\Http\Controllers\Api\SuperAdmin\UserController;
use App\Http\Controllers\Api\User\InventoryController;
use App\Http\Controllers\Api\User\ReportController;
use App\Http\Controllers\Api\User\ReturnController;
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

Route::get('export', [DashboardController::class, 'exportData'])->name('export.omset');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // dashboard
    Route::get('/omset', [DashboardController::class, 'allOmsets'])->name('omset');
    Route::get('/chart', [DashboardController::class, 'chart'])->name('bar.omset.chart');
    Route::get('/persentase-cs', [DashboardController::class, 'persentaseCS'])->name('persentase.cs');
    // cs report
    Route::get('/cs-reports', [ReportController::class, 'indexCS'])->name('index.report.cs');
    Route::get('/cs-reports/{date}', [ReportController::class, 'indexDateCS'])->name('index.report.cs.date');
    Route::post('/cs-reports/customers', [ReportController::class, 'addCustomerCS'])->name('store.report.cs');
    Route::post('/cs-reports/add', [ReportController::class, 'addReportCS'])->name('store.report.cs.add');
    Route::get('/add-product-form/{id}', [ReportController::class, 'addProductForm'])->name('add.product.form');
    Route::post('/add-product-form',[ReportController::class, 'submitProductOrder'])->name('add.product.submit');
    Route::get('/edit-product-form/{id}', [ReportController::class, 'editProductForm'])->name('edit.product.form');
    Route::post('/update-product-form/{id}',[ReportController::class, 'updateProductOrder'])->name('add.product.update');
    Route::delete('/delete-product-order/{id}',[ReportController::class, 'deleteOrderProduct'])->name('delete.order.product');
    Route::get('/list-user-cs', [ReportController::class, 'listUserCS'])->name('list.user.cs');
    Route::get('/list-user-all-cs', [ReportController::class, 'listAllUserCS'])->name('list.user.all.cs');
    Route::get('/view-report-order/{id}', [ReportController::class, 'viewOrderReport'])->name('view.order.report.id');
    // adv report
    Route::get('/adv-reports', [ReportController::class, 'indexADV'])->name('index.report.adv');
    Route::get('/order', [ReportController::class, 'getOrder'])->name('get.order');
    Route::get('/lead-masuk', [ReportController::class, 'leadCS'])->name('get.lead');
    Route::post('/adv-reports', [ReportController::class, 'storeADV'])->name('store.report.adv');
    // superadmin
    Route::resource('/positions', PositionController::class)->except(['show', 'create']);
    Route::resource('/products', ProductController::class);
    Route::get('/all-product', [ProductController::class, 'allProduct'])->name('get.all.product');
    Route::resource('/teams', UserController::class)->except(['create', 'show', 'update']);
    Route::get('/teams/{slug}', [UserController::class, 'show'])->name('teams.show.slug');
    Route::post('/teams-update/{id}', [UserController::class, 'update'])->name('teams.update');

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
    // inventory
    Route::resource('/inventorys', InventoryController::class)->except(['show', 'create']);
    Route::get('/inventorys/usage', [InventoryController::class, 'indexDetail'])->name('inventory.usege.index');
    Route::post('/inventorys/usage', [InventoryController::class, 'storeDetail'])->name('inventory.usege.store');
    Route::get('/inventorys/usage/{slug}', [InventoryController::class, 'showDetail'])->name('inventory.usege.show');
    // return
    Route::get('/get-order', [ReturnController::class, 'index'])->name('get.order');
    Route::get('/get-return', [ReturnController::class, 'orderReturn'])->name('get.order.return');
    Route::get('/order-detail/{waybill}', [ReturnController::class, 'OrderDetail'])->name('get.detail.order.show');
    Route::post('/return-post', [ReturnController::class, 'store'])->name('return.add');

});
