<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        $currentUser  = auth()->user();
        $userBranches = $this->getUserBranches($currentUser->id);
        $branches     = DB::table('branches')
                          ->whereIn('id', $userBranches)
                          ->select('id', 'name')
                          ->get();

        $month = $request->input('month');
        $year  = $request->input('year');

        $salesChartData        = $this->getSalesChart($userBranches, $branches, $month, $year);
        $transactionsChartData = $this->getTransactionsChart($userBranches, $branches, $month, $year);
        $salesTotals           = $this->getSalesTotals($userBranches, $month, $year);

        return Inertia::render('Admin/Statistics/StatisticsIndex', [
            'branches' => $branches,
            'salesChartData' => $salesChartData,
            'transactionsChartData' => $transactionsChartData,
            'salesTotals' => $salesTotals
        ]);
    }

    private function getUserBranches($userId)
    {
        return DB::table('franchisee_users_branches as fub')
                 ->where('fub.user_id', $userId)
                 ->pluck('fub.branch_id')
                 ->toArray();
    }

    private function getSalesData(array $userBranches, $month = null, $year = null)
    {
        return $this->getData('sales_orders as so', 'so.status', 'so.branch_id', $userBranches, $month, $year);
    }

    private function getTransactionsData(array $userBranches, $month = null, $year = null)
    {
        return $this->getData('bookings as b', 'b.status', 'b.branch_id', $userBranches, $month, $year);
    }

    private function getData($table, $statusField, $branchField, array $userBranches, $month = null, $year = null)
    {
        $query = DB::table($table)
                   ->select($statusField, $branchField, DB::raw('COUNT(*) as total'))
                   ->whereIn($branchField, $userBranches);

        if ($month || $year) {
            $query->whereMonth('created_at', $month)
                  ->whereYear('created_at', $year);
        }

        return $query->groupBy($statusField, $branchField)->get();
    }

    private function getChartData(array $userBranches, $branches, Request $request, $chartType)
    {
        $method = $chartType === 'sales' ? 'getSalesData' : 'getTransactionsData';
        $data   = $this->$method($userBranches, $request->input('month'), $request->input('year'));

        $statuses = $data->pluck('status')->unique()->values()->toArray();
        $series   = $branches->map(function ($branch) use ($data, $statuses) {
            $branchData = $data->where('branch_id', $branch->id);
            return [
                'name' => $branch->name,
                'data' => array_map(function ($status) use ($branchData) {
                        return $branchData->where('status', $status)->sum('total');
                    }, $statuses),
            ];
        });

        return [
            'labels' => $statuses,
            'series' => $series,
        ];
    }

    private function getSalesChart(array $userBranches, $branches, $month = null, $year = null)
    {
        return $this->getChartData($userBranches, $branches, request(), 'sales');
    }

    private function getTransactionsChart(array $userBranches, $branches, $month = null, $year = null)
    {
        return $this->getChartData($userBranches, $branches, request(), 'transactions');
    }

    private function getSalesTotals(array $userBranches, $month = null, $year = null)
    {
        // return DB::table('sales_orders as so')
        //     ->leftJoin('branches as b', 'b.id', '=', 'so.branch_id')
        //     ->select(
        //         'b.name as branch_name',
        //         DB::raw('COALESCE(SUM(CASE WHEN so.status = "PAID" THEN so.grand_total ELSE 0 END), 0) as total_paid'),
        //         DB::raw('COALESCE(SUM(CASE WHEN so.status = "BILLED" THEN so.grand_total ELSE 0 END), 0) as total_billed'),
        //         DB::raw('COALESCE(SUM(CASE WHEN so.status = "VOIDED" THEN so.grand_total ELSE 0 END), 0) as total_voided')
        //     )
        //     ->whereIn('so.branch_id', $userBranches)
        //     ->when($month || $year, function ($query) use ($month, $year) {
        //         $query->whereMonth('so.created_at', $month)
        //               ->whereYear('so.created_at', $year);
        //     })
        //     ->groupBy('b.name', 'so.branch_id')
        //     ->get();
    }
}

