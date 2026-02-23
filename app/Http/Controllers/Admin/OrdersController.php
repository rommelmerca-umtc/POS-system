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

                $order['quantity'] = $request->quantity;
                $unitPrice         = $order['rate_per_unit'];
                $area              = $order['width'] * $order['height'];

                $order['total_price'] = $unitPrice * $area * $request->quantity;
                break;
            }
        }

        session()->put('orders', $orders);
        return back();
    }

    public function removeOrder(Request $request, $id)
    {
        $orders = session()->get('orders', []);
        $orders = array_filter($orders, fn($order) => $order['id'] !== $id);
        session()->put('orders', array_values($orders));
        return back();
    }
}
