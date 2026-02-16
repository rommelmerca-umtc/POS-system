<?php

use App\Http\Controllers\Admin\BranchesController as AdminBranchesControlller;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SalesReportsController as AdminSalesReportsController;
use App\Http\Controllers\Admin\StatisticsController as AdminStatisticsController;
use App\Http\Controllers\Admin\TransactionsReportsController as AdminTransactionsReportsController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::middleware(['auth', 'isUser'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard.index');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    // Admin Dashboard Routes
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');

    // Admin Branches Routes
    Route::get('/branches', [AdminBranchesControlller::class, 'index'])->name('admin.branches.index');
    Route::post('/branches/remove', [AdminBranchesControlller::class, 'removeBranch'])->name('admin.branches.remove');
    Route::get('/branches/statistics/{branch_id}', [AdminBranchesControlller::class, 'statistics'])->name('admin.branches.statistics');
    Route::get('/branches/branchTransactions', [AdminBranchesControlller::class, 'getBranchTodayTransactions'])->name('admin.branches.branchTransactions');
    Route::get('/branches/branchSales', [AdminBranchesControlller::class, 'getBranchTodaySales'])->name('admin.branches.branchSales');

    // Admin Reports Routes
    Route::get('/sales_reports', [AdminSalesReportsController::class, 'index'])->name('admin.sales-reports.index');
    Route::get('/transactions_reports', [AdminTransactionsReportsController::class, 'index'])->name('admin.transactions-reports.index');

    // Admin Statistics Routes
    Route::get('/statistics', [AdminStatisticsController::class, 'index'])->name('admin.statistics.index');
});

require __DIR__.'/auth.php';
