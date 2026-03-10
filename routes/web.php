<?php

use App\Http\Controllers\Admin\BranchesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\SalesReportsController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\TransactionsReportsController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'home'])->name('home');

// Route::middleware(['auth', 'isUser'])->prefix('user')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard.index');
// });

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    // Admin Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'dashboardPage'])->name('admin.dashboard.index');
    
    // Orders Routes
    Route::get('/orders', [OrdersController::class, 'showOrdersPage'])->name('admin.orders.index');
    Route::get('/orders/create-page', [OrdersController::class, 'showCreateOrderPage'])->name('admin.orders.create-order-page');
    Route::post('/orders/create', [OrdersController::class, 'createOrder'])->name('admin.orders.create-order');
    Route::post('/orders/update-quantity/{order_id}', [OrdersController::class, 'updateOrderItemQuantity'])->name('admin.orders.update-orders-quantity');
    Route::delete('/orders/item/remove/{order_id}', [OrdersController::class, 'removeOrderItem'])->name('admin.orders.remove-order');
    Route::post('/orders/client/create', [OrdersController::class, 'createClient'])->name('admin.orders.client-create');
    Route::get('/orders/client/search', [OrdersController::class, 'searchClient'])->name('admin.orders.search-client');
    Route::post('/orders/confirm', [OrdersController::class, 'confirmOrder'])->name('admin.orders.confirm-order');
    Route::get('/orders/details/{id}', [OrdersController::class, 'getOrderDetails']) ->name('admin.orders.details');
    Route::post('/orders/clear', [OrdersController::class, 'clearSessionOrders']) ->name('admin.orders.clear-orders');
    Route::post('/orders/cancel', [OrdersController::class, 'cancelSessionOrders'])->name('admin.orders.cancel-orders');
    Route::get('/orders/update-page/{orderId}', [OrdersController::class, 'showUpdateOrderPage'])->name('admin.orders.update-page');
    Route::put('/orders/update/{orderId}', [OrdersController::class, 'updateOrder'])->name('admin.orders.update');
    Route::patch('/orders/update-item/{itemId}', [OrdersController::class, 'updateOrderItem'])->name('admin.orders.update-item');
    Route::delete('/orders/remove-item/{itemId}', [OrdersController::class, 'removeOrderedItem'])->name('admin.orders.remove-item');
    Route::post('/orders/add-item/{orderId}', [OrdersController::class, 'addOrderItem'])->name('admin.orders.add-item');

    // Admin Branches Routes
    Route::get('/branches', [BranchesController::class, 'index'])->name('admin.branches.index');
    Route::post('/branches/remove', [BranchesController::class, 'removeBranch'])->name('admin.branches.remove');
    Route::get('/branches/statistics/{branch_id}', [BranchesController::class, 'statistics'])->name('admin.branches.statistics');
    Route::get('/branches/branchTransactions', [BranchesController::class, 'getBranchTodayTransactions'])->name('admin.branches.branchTransactions');
    Route::get('/branches/branchSales', [BranchesController::class, 'getBranchTodaySales'])->name('admin.branches.branchSales');

    // Admin Reports Routes
    Route::get('/sales_reports', [SalesReportsController::class, 'index'])->name('admin.sales-reports.index');
    Route::get('/transactions_reports', [TransactionsReportsController::class, 'index'])->name('admin.transactions-reports.index');

    // Admin Statistics Routes
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('admin.statistics.index');
});

require __DIR__.'/auth.php';
