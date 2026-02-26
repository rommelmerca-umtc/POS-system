<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\Products\Product;
use Illuminate\Support\Str;
use App\Models\Clients\Client;

class OrdersController extends Controller
{
    public function ordersPage(Request $request)
    {
        $ordersQuery = DB::table('orders as o')
                    ->leftJoin('clients as c', 'o.client_id', '=', 'c.client_id')
                    ->select(
                        'o.id', 
                        'o.client_id', 
                        'o.grand_total', 
                        'o.payment_method',
                        'o.payment_status', 
                        'o.payment_due', 
                        'o.status', 
                        'o.created_at',
                        DB::raw("CONCAT(c.first_name, ' ', c.last_name) as client_name"),
                        'c.client_id',
                        'c.email'
                    )
                    ->when($request->payment_status, function ($query) use ($request) {
                        $query->whereIn('o.payment_status', $request->get('payment_status'));
                    })
                    ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                        $query->whereBetween('o.created_at', [
                            $request->get('start_date'),
                            $request->get('end_date'),
                        ]);
                    })
                    ->when($request->search, function ($query) use ($request) {
                        $search = $request->search;
                        $query->where(function ($q) use ($search) {
                            $q->where('c.first_name', 'like', "%$search%")
                            ->orWhere('c.last_name', 'like', "%$search%")
                            ->orWhere('c.client_id', 'like', "%$search%")
                            ->orWhere('c.email', 'like', "%$search%")
                            ->orWhere('o.payment_status', 'like', "%$search%")
                            ->orWhereRaw("DATE_FORMAT(o.created_at, '%M %d, %Y') like ?", ["%$search%"]);
                        });
                    })
                    ->orderBy('o.id', 'ASC');

        $orders = $ordersQuery->paginate(10);

        return Inertia::render('Admin/Orders/OrdersIndex', [
            'orders' => $orders,
        ]);
    }

    public function createOrderPage(Request $request)
    {
        $currentUser  = auth()->user();
        $products     = Product::all();

        return Inertia::render('Admin/Orders/Components/OrderingCreatePage', [
            'currentUser'    => $currentUser,
            'products'       => $products,
            'sessionOrders'  => session()->get('orders', []),
            'searchedClient' => session('searchedClient')
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

    public function createClient(Request $request)
    {
        $createdClient = Client::create([
            'client_id'    => 'CL-' . Str::upper(Str::random(6)),
            'first_name'   => $request->client_firstname,
            'last_name'    => $request->client_lastname,
            'email'        => $request->client_email,
            'phone_number' => $request->client_mobile_number,
            'address'      => $request->client_address
        ]);

        return redirect()->back()->with('createdClient', $createdClient);
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'createdClient' => fn () => $request->session()->get('createdClient'),
        ]);
    }

    public function searchClient(Request $request) 
    {
        $searchedClient = DB::table('clients as c')
                        ->select([
                            'c.client_id',
                            'c.first_name',
                            'c.last_name',
                            'c.email',
                            'c.phone_number',
                            'c.address',
                        ])->when($request->search, function ($query) use ($request) {
                            $search = $request->search;
                            $query->where(function ($q) use ($search) {
                                $q->where('c.client_id', 'like', "%$search%")
                                ->orWhere('c.first_name', 'like', "%$search%")
                                ->orWhere('c.last_name', 'like', "%$search%")
                                ->orWhere('c.email', 'like', "%$search%")
                                ->orWhere('c.phone_number', 'like', "%$search%")
                                ->orWhere('c.address', 'like', "%$search%");
                            });
                        })
                        ->first();

        return redirect()->back()->with([
            'searchedClient' => $searchedClient
        ]);
    }

    public function confirmOrder(Request $request)
    {
        DB::beginTransaction();
        try {
           $sessionOrders = session('orders');

            if (empty($sessionOrders)) {
                throw new \Exception('No orders in session');
            }

            $totalAmount        = collect($sessionOrders)->sum('total_price');
            $vatRate            = 0.12;
            $serviceChargeRate  = 0.05;
            $vat                 = $totalAmount * $vatRate;
            $serviceCharge       = $request->is_service_charged ? ($totalAmount + $vat) * $serviceChargeRate : 0;
            $finalAmount         = $totalAmount + $vat + $serviceCharge;

            $orderId = DB::table('orders')->insertGetId([
                'client_id'      => $request->client_id,
                'payment_method' => $request->payment_method,
                'payment_due'    => $request->payment_due,
                'payment_status' => $request->payment_status,
                'sub_total'      => $totalAmount,
                'grand_total'    => $finalAmount,
                'vat'            => $vat,
                'service_charge' => $serviceCharge,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
            foreach ($sessionOrders as $item) {
                DB::table('order_items')->insert([
                    'sales_order_id' => $orderId,
                    'product_id'     => $item['product_id'],
                    'quantity'       => $item['quantity'],
                    'width'          => $item['width'],
                    'height'         => $item['height'],
                    'rate_per_unit'  => $item['rate_per_unit'],
                    'total_price'    => $item['total_price'],
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
            }

            session()->forget('orders');

            DB::commit();
            return back()->with([
                'sessionOrders' => []
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage()); 
        }
    }

    public function getOrderDetails($orderId)
    {
        $order = DB::table('orders as o')
            ->leftJoin('clients as c', 'o.client_id', '=', 'c.client_id')
            ->select(
                'o.id',
                'o.client_id',
                'o.grand_total',
                'o.payment_method',
                'o.payment_status',
                'o.payment_due',
                'o.status',
                'o.created_at',
                DB::raw("CONCAT(c.first_name, ' ', c.last_name) as client_name"),
                'c.email',
            )
            ->where('o.id', $orderId)
            ->first();

        $orderItems = DB::table('order_items as oi')
            ->leftJoin('products as p', 'oi.product_id', '=', 'p.id')
            ->select(
                'oi.id',
                'oi.product_id',
                'p.name',
                'oi.quantity',
                'oi.rate_per_unit',
                'oi.width',
                'oi.height',
                'oi.total_price'
            )
            ->where('oi.sales_order_id', $orderId)
            ->get();

        return response()->json([
            'order' => $order,
            'items' => $orderItems
        ]);
    }
}
