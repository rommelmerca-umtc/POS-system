<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class SalesReportsController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = auth()->user();

        $userBranches = DB::table('franchisee_users_branches')
                    ->where('user_id', $currentUser->id)
                    ->pluck('branch_id')
                    ->toArray();

        $branches = DB::table('branches')
                ->whereIn('id', $userBranches)
                ->select('id', 'name')
                ->get();

        // $salesReportsQuery = DB::table('sales_orders as so')
        //                 ->leftJoin('branches as b', 'b.id', '=', 'so.branch_id')
        //                 ->leftJoin('customers as c', 'c.id', '=', 'so.customer_id')
        //                 ->select([
        //                     'so.id as sales_order_id',
        //                     'b.id as branch_id',
        //                     'b.name as branch_name',
        //                     'c.id as customer_id',
        //                     'c.full_name as customer_name',
        //                     'so.booking_id as booking_id',
        //                     'so.reference_number as reference_number',
        //                     'so.invoice_number as invoice_number',
        //                     'so.wax_amount as wax_amount',
        //                     'so.status as sales_status',
        //                     'so.subtotal as sub_total',
        //                     'so.discount_total as discount_total',
        //                     'so.grand_total as grand_total',
        //                     DB::raw("DATE_FORMAT(so.created_at, '%M %d, %Y') as date"),
        //                 ])
        //                 ->whereIn('so.branch_id', $userBranches)
        //                 ->when($request->branch_ids, function ($query) use ($request) {
        //                     $query->whereIn('so.branch_id', $request->get('branch_ids'));
        //                 })
        //                 ->when($request->sales_status, function ($query) use ($request) {
        //                     $query->whereIn('so.status', $request->get('sales_status'));
        //                 })
        //                 ->when($request->start_date && $request->end_date, function ($query) use ($request) {
        //                     $query->whereBetween('so.created_at', [
        //                         $request->get('start_date'),
        //                         $request->get('end_date'),
        //                     ]);
        //                 })
        //                 ->when($request->search, function ($query) use ($request) {
        //                     $search = $request->search;
        //                     $query->where(function ($q) use ($search) {
        //                         $q->where('b.name', 'like', "%$search%")
        //                         ->orWhere('c.full_name', 'like', "%$search%")
        //                         ->orWhere('so.reference_number', 'like', "%$search%")
        //                         ->orWhere('so.invoice_number', 'like', "%$search%")
        //                         ->orWhere('so.status', 'like', "%$search%")
        //                         ->orWhereRaw("DATE_FORMAT(so.created_at, '%M %d, %Y') like ?", ["%$search%"]);
        //                     });
        //                 })
        //                 ->orderBy('so.id', 'ASC');

        // $salesReports = $salesReportsQuery->paginate(10);

        // return Inertia::render('Admin/Reports/SalesReportIndex', [
        //     'salesReports' => $salesReports,
        //     'branches'     => $branches,
        // ]);
    }
}
