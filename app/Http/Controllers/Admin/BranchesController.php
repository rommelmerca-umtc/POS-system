<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BranchesController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = auth()->user();

        $branches = DB::table('branches as b')
                    ->leftJoin('franchisee_users_branches as fub', 'fub.branch_id', '=', 'b.id')
                    ->select([
                        'b.id as branch_id',
                        'b.name as branch_name',
                        'b.status as branch_status',
                        'b.address as branch_address',
                    ])
                    ->when($request->search, function ($query) use ($request) {
                        $search = $request->search;
                        $query->where(function ($q) use ($search) {
                            $q->where('b.name', 'like', "%$search%")
                            ->orWhere('b.id', 'like', "%$search%")
                            ->orWhere('b.status', 'like', "%$search%")
                            ->orWhere('b.address', 'like', "%$search%");
                        });
                    })
                    ->where('fub.user_id', $currentUser->id)
                    ->get();

        return Inertia::render('Admin/Branches/BranchesIndex', ['branches' => $branches]);
    }

    public function removeBranch(Request $request)
    {
        $currentUser = auth()->user();
        $branchId    = $request->branch_id;

        try {
            DB::table('franchisee_users_branches')
                ->where('user_id', $currentUser->id)
                ->where('branch_id', $branchId)
                ->delete();

            return response()->json(['success' => true, 'message' => 'Branch removed successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error removing branch.'], 500);
        }
    }

    public function getBranchTodayTransactions(Request $request)
    {
        $request->validate(['branch_id' => 'required|integer']);

        $bookings = DB::table('bookings as b')
                ->leftJoin('branches as br', 'br.id', '=', 'b.branch_id')
                ->leftJoin('product_baskets as pb', 'pb.branch_id', '=', 'br.id')
                ->selectRaw('
                    br.name as branch_name,
                    br.id as branch_id,
                    SUM(CASE WHEN b.status = 1 THEN 1 ELSE 0 END) as pending_count,
                    SUM(CASE WHEN b.status = 2 THEN 1 ELSE 0 END) as ongoing_count,
                    SUM(CASE WHEN b.status = 3 THEN 1 ELSE 0 END) as cancelled_count,
                    SUM(CASE WHEN b.status = 4 THEN 1 ELSE 0 END) as finished_count,
                    SUM(CASE WHEN b.status = 5 THEN 1 ELSE 0 END) as expired_count,
                    SUM(CASE WHEN b.status = 6 THEN 1 ELSE 0 END) as voided_count,
                    COUNT(DISTINCT pb.id) as product_bookings_count,
                    SUM(pb.total_price) as product_total_price,
                    SUM(CASE WHEN b.status = 1 THEN b.total_price ELSE 0 END) as pending_total_price,
                    SUM(CASE WHEN b.status = 2 THEN b.total_price ELSE 0 END) as ongoing_total_price,
                    SUM(CASE WHEN b.status = 3 THEN b.total_price ELSE 0 END) as cancelled_total_price,
                    SUM(CASE WHEN b.status = 4 THEN b.total_price ELSE 0 END) as finished_total_price,
                    SUM(CASE WHEN b.status = 5 THEN b.total_price ELSE 0 END) as expired_total_price,
                    SUM(CASE WHEN b.status = 6 THEN b.total_price ELSE 0 END) as voided_total_price
                ')
                ->where('br.id', $request->branch_id)
                ->groupBy('br.id', 'br.name')
                ->get();

        return response()->json(['bookings' => $bookings]);
    }

    public function getBranchTodaySales(Request $request)
    {
        $request->validate(['branch_id' => 'required|integer']);

        // $salesOrders = DB::table('sales_orders as so')
        //     ->leftJoin('branches as br', 'br.id', '=', 'so.branch_id')
        //     ->selectRaw('
        //         br.name as branch_name,
        //         br.id as branch_id,
        //         SUM(CASE WHEN so.status = "BILLED" THEN 1 ELSE 0 END) as billed_sales_count,
        //         SUM(CASE WHEN so.status = "BILLED" THEN so.grand_total ELSE 0 END) as billed_sales_amount,
        //         SUM(CASE WHEN so.status = "PAID" THEN 1 ELSE 0 END) as paid_sales_count,
        //         SUM(CASE WHEN so.status = "PAID" THEN so.grand_total ELSE 0 END) as paid_sales_amount,
        //         SUM(CASE WHEN so.status = "VOIDED" THEN 1 ELSE 0 END) as voided_sales_count,
        //         SUM(CASE WHEN so.status = "VOIDED" THEN so.grand_total ELSE 0 END) as voided_sales_amount'
        //     )
        //     ->where('so.branch_id', $request->branch_id)
        //     ->groupBy('br.id', 'br.name')
        //     ->get();

        // return response()->json(['salesOrders' => $salesOrders]);
    }

    public function statistics(Request $request)
    {
        return Inertia::render('Admin/Branches/BranchStatisticsIndex', []);
    }
}
