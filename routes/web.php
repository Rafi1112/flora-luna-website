<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Article\{ArticleController, ArticleCategoryController};
use App\Http\Controllers\{IndexController, Product\ProductCategoryController, StoreController};
use App\Http\Controllers\RolePermission\{RoleController,
    PermissionController,
    RolePermissionController,
    UserRoleController};
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::prefix('account')->middleware('auth')->group(function () {
    Route::get('', [AccountController::class, 'index'])->name('account');
    Route::put('', [AccountController::class, 'updateProfile']);
    Route::get('change-password', [AccountController::class, 'changePassword'])->name('change.password');
    Route::put('change-password', [AccountController::class, 'updatePassword']);
});

Route::prefix('itemshop')->group(function () {
    Route::get('', [StoreController::class, 'index'])->name('store');
});

Route::prefix('p')->middleware(['auth', 'role:Game Master|Moderator'])->group(function () {
    Route::prefix('announcement')->middleware(['permission:create post'])->group(function () {
        Route::get('', [ArticleController::class, 'index'])->name('article.index');
        Route::get('create', [ArticleController::class, 'create'])->name('article.create');
        Route::post('create', [ArticleController::class, 'store']);
        Route::get('{article:slug}', [ArticleController::class, 'edit'])->name('article.edit');
        Route::put('{article:slug}', [ArticleController::class, 'update']);
        Route::delete('{article:slug}', [ArticleController::class, 'destroy'])->name('article.delete');
        Route::post('/image-content/delete', [ArticleController::class, 'deleteImageContent'])->name('delete.content.image');
        Route::prefix('category')->group(function () {
            Route::get('', [ArticleCategoryController::class, 'index'])->name('article.category');
            Route::post('', [ArticleCategoryController::class, 'store'])->name('article.category');
            Route::get('{category:slug}', [ArticleCategoryController::class, 'edit'])->name('article.category.edit');
            Route::put('{category:slug}', [ArticleCategoryController::class, 'update'])->name('article.category.update');
            Route::delete('{category:slug}', [ArticleCategoryController::class, 'destroy'])->name('article.category.delete');
        });
    });
    Route::prefix('product')->middleware(['permission:create product|create item'])->group(function () {
        Route::get('category', [ProductCategoryController::class, 'index'])->name('product.category.index');
        Route::post('category', [ProductCategoryController::class, 'store'])->name('product.category.store');
        Route::get('category/{category:slug}/edit', [ProductCategoryController::class, 'edit'])->name('product.category.edit');
        Route::put('category/{category:slug}/edit', [ProductCategoryController::class, 'update']);
        Route::delete('category/{category:slug}/delete', [ProductCategoryController::class, 'destroy'])->name('product.category.delete');
    });
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
