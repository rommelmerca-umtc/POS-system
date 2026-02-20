<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\Products\Product;

class OrdersController extends Controller
{

    public function ordersPage(Request $request)
    {
        $currentUser  = auth()->user();

        $orders = DB::table('sales_orders as so')
                        ->join('branches as b', 'so.branch_id', '=', 'b.id')
                        ->select('so.id', 'so.grand_total', 'so.status', 'b.name as branch_name')
                        ->paginate(10);

        return Inertia::render('Admin/Orders/OrdersIndex', [
            'orders' => $orders,
        ]);
    }

    public function createOrderPage(Request $request)
    {
        $currentUser  = auth()->user();
        $products     = Product::all();

        return Inertia::render('Admin/Orders/Components/OrderingCreatePage', [
            'currentUser' => $currentUser,
            'products'    => $products
        ]);
    }
}
