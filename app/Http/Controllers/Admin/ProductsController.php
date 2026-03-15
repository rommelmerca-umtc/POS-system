<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\Products\Product;
use Illuminate\Support\Str;
use App\Models\Clients\Client;
use App\Models\Orders\Order;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = DB::table('products as p')
                    ->select([
                        'p.id as product_id',
                        'p.name as product_name',
                        'p.image_url as product_image',
                        'p.description as product_desc',
                        'p.default_price as product_def_price',
                        'p.default_width as product_def_width',
                        'p.default_height as product_def_height',
                        'p.default_unit as product_def_unit',
                        'p.created_at as created_at',
                        'p.updated_at as created_at',
                    ])
                    ->when($request->search, function ($query) use ($request) {
                        $search = $request->search;
                        $query->where(function ($q) use ($search) {
                            $q->where('p.name', 'like', "%$search%")
                            ->orWhere('p.id', 'like', "%$search%")
                            ->orWhere('p.description', 'like', "%$search%");
                        });
                    })
                    ->get();

        return Inertia::render('Admin/Products/ProductsIndex', ['products' => $products]);
    }
}