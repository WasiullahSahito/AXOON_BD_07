<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductItem;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    public function index()
    {
        $topCustomers = User::withCount(['orders as total_orders'])
            ->withSum('orders as total_spent', 'total')
            ->orderByDesc('total_spent')
            ->limit(10)
            ->get();

        $bestSelling = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        return view('admin.pages.reports.index', compact('topCustomers', 'bestSelling'));
    }
}
