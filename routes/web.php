<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\RolePermission\{RoleController,
    PermissionController,
    RolePermissionController,
    UserRoleController};
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Route::prefix('p')->middleware(['auth', 'role:Game Master|Moderator'])->group(function () {
    Route::prefix('role-permission')->middleware(['permission:assign permission'])->group(function () {

        Route::prefix('role')->group(function () {
            Route::get('', [RoleController::class, 'index'])->name('role.index');
            Route::post('', [RoleController::class, 'store'])->name('role.store');
            Route::get('{role}', [RoleController::class, 'edit'])->name('role.update');
            Route::put('{role}', [RoleController::class, 'update']);
            Route::delete('{role}', [RoleController::class, 'destroy'])->name('role.delete');
        });

        Route::prefix('permission')->group(function () {
            Route::get('', [PermissionController::class, 'index'])->name('permission.index');
            Route::post('', [PermissionController::class, 'store'])->name('permission.store');
            Route::get('{permission}', [PermissionController::class, 'edit'])->name('permission.update');
            Route::put('{permission}', [PermissionController::class, 'update']);
            Route::delete('{permission}', [PermissionController::class, 'destroy'])->name('permission.delete');
        });

        Route::get('sync', [RolePermissionController::class, 'index'])->name('sync.index');
        Route::post('sync-role-permissions', [RolePermissionController::class, 'sync'])->name('sync.role.permission');

        Route::get('user-role', [UserRoleController::class, 'index'])->name('user.role');
        Route::post('user-role', [UserRoleController::class, 'sync'])->name('sync.user.role');
    });
});

require __DIR__.'/auth.php';
