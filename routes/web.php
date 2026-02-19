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
    Route::get('/orders', [OrdersController::class, 'ordersPage'])->name('admin.orders.index');
    Route::get('/create-order-page', [OrdersController::class, 'createOrderPage'])->name('admin.orders.create-order-page');

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
