<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\API\Bodega\BodegaController;
use App\Http\Controllers\Back_end\DashboardController;
use App\Http\Controllers\Back_end\Users\RoleController;
use App\Http\Controllers\Back_end\Users\UserController;
use App\Http\Controllers\Back_end\Users\ModuleController;
use App\Http\Controllers\Back_end\Users\UsersPermissions;
use App\Http\Controllers\Back_end\Users\LeadersController;
use App\Http\Controllers\Back_end\Users\PermissionController;
use App\Http\Controllers\Back_end\Users\PermissionsAsignation;
use App\Http\Controllers\Back_end\Users\RolesPermissionsController;

Route::get('/', function () {
    return redirect('login');
});

Route::post('log_in', [LoginController::class, 'login'])->name("log_in");
Route::post('logout', [LoginController::class, 'logout'])->name("log_out");

Route::get('/bodega', [BodegaController::class, 'index'])->name("bodega");
Route::resource('materiales', BodegaController::class);

Route::middleware(['auth:web', 'checkuseractive', 'verified'])->group(

    function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name("dashboard");
        Route::get('barJSChartData', [DashboardController::class, 'barJSChartData'])->name("barJSChartData");
        Route::get('barDataChart', [DashboardController::class, 'barDataChart'])->name("barDataChart");
        Route::get('lineJSChartData', [DashboardController::class, 'lineJSChartData'])->name("lineJSChartData");
        
        /* Route::get('pieChartData', [DashboardController::class, 'pieChartData'])->name("pieChartData");
        Route::get('barChartData', [DashboardController::class, 'barChartData'])->name("barChartData");
        Route::get('comboChartData', [DashboardController::class, 'comboChartData'])->name("comboChartData");
        Route::get('columnChartData', [DashboardController::class, 'columnChartData'])->name("columnChartData"); */
     
        Route::resource('users', UserController::class);
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('export', [UserController::class, 'export'])->name('excelUsers');
        Route::get('exportPdf', [UserController::class, 'exportPdf'])->name('exportPdf');
        Route::get('sendEmail', [UserController::class, 'sendEmail'])->name('sendEmail');

        Route::resource('leaders', LeadersController::class);
        Route::get('/leaders', [LeadersController::class, 'index'])->name('leaders');

        Route::resource('permissions_asignation', PermissionsAsignation::class);
        Route::get('/permissions_asignation', [PermissionsAsignation::class, 'index'])->name('permissions_asignation');
        Route::get('/getRolePermissions', [PermissionsAsignation::class, 'getRolePermissions'])->name('getRolePermissions');

        Route::resource('users_permissions', UsersPermissions::class);
        Route::get('/getUserPermissions', [UsersPermissions::class, 'getUserPermissions'])->name('getUserPermissions');

        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('modules', ModuleController::class);
        Route::get('/roles_permissions', [RolesPermissionsController::class, 'index'])->name('roles_permissions');
    }
);

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
