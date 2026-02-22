<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\Products\Product;
use Illuminate\Support\Str;

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
            'currentUser'   => $currentUser,
            'products'      => $products,
            'sessionOrders' => session()->get('orders', []),
        ]);
    }

    public function createOrder(Request $request)
    {
        $requestData = $request->validate([
            'product_id'    => 'required|integer|exists:products,id',
            'quantity'      => 'required|numeric|min:1',
            'width'         => 'required|numeric|min:0',
            'height'        => 'required|numeric|min:0',
            'unit'          => 'required|string',
            'rate_per_unit' => 'required|numeric|min:0',
            'total_price'   => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($requestData['product_id']);

        $orderItem = array_merge($requestData, [
            'id'                  => (string) Str::uuid(),
            'product_name'        => $product->name,
            'product_image'       => $product->image_url,
            'product_description' => $product->description,
        ]);

        $orders   = session()->get('orders', []);
        $orders[] = $orderItem;
        session()->put('orders', $orders);

        return back(); 
    }

    public function updateOrder(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $orders = session()->get('orders', []);

        foreach ($orders as &$order) {

            if ($order['id'] == $id) {
                $order['quantity']    = $request->quantity;
                $unitPrice            = $order['unit_price'] ?? 0;
                $order['total_price'] = $unitPrice * $request->quantity;
                break;
            }
        }
        session()->put('orders', $orders);
        return back();
    }
}
