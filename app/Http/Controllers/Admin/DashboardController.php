<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'users'    => User::count(),
            'orders'   => Order::count(),
            'revenue'  => Order::sum('total'),
        ];

        return view('admin.pages.dashboard', compact('stats'));
    }

}
