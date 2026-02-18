<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function dashboardPage(Request $request)
    {
        $currentUser = auth()->user();

        $userBranches         = $this->getUserBranches($currentUser->id);
        $paidSales            = $this->getSalesData($userBranches);
        $finishedTransactions = $this->getTransactionData($userBranches);

        return Inertia::render('Admin/Dashboard', [
            'userBranches'         => $userBranches,
            'paidSales'            => $paidSales,
            'finishedTransactions' => $finishedTransactions
        ]);
    }

    private function getUserBranches($userId)
    {
        return DB::table('franchisee_users_branches as fub')
            ->where('fub.user_id', $userId)
            ->pluck('fub.branch_id')
            ->toArray();
    }

    private function getSalesData(array $userBranches)
    {
        return DB::table('sales_orders as so')
            ->select(
                DB::raw('SUM(CASE WHEN so.status = "PAID" THEN so.grand_total ELSE 0 END) as paid_sales_amount'),
                DB::raw('COUNT(CASE WHEN so.status = "PAID" THEN 1 ELSE NULL END) as paid_sales_count')
            )
            ->whereIn('so.branch_id', $userBranches)
            ->first();
    }

    private function getTransactionData(array $userBranches)
    {
        return DB::table('bookings as b')
            ->select(
                DB::raw('SUM(CASE WHEN b.status = 4
                 THEN b.total_price ELSE 0 END) as finished_transactions_amount'),
                DB::raw('COUNT(CASE WHEN b.status = 4 THEN 1 ELSE NULL END) as finished_transactions_count')
            )
            ->whereIn('b.branch_id', $userBranches)
            ->first();
    }
}
