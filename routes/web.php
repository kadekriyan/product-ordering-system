<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return redirect()->route('admin.orders.index');
});

Route::get('/admin/orders', [OrderController::class, 'index']);
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::get('/admin/orders/{order}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
Route::put('/admin/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
Route::delete('/admin/orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
