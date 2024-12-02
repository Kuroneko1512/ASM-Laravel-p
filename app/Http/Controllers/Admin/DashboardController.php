<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalUsers' => User::count(),
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            // 'totalOrders' => Order::count(),
            
            // 'pendingOrders' => Order::where('status', 'pending')->count(),
            // 'processingOrders' => Order::where('status', 'processing')->count(),
            // 'shippingOrders' => Order::where('status', 'shipping')->count(),
            // 'completedOrders' => Order::where('status', 'completed')->count(),
            
            'userChartLabels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'userChartData' => [65, 59, 80, 81, 56, 55],
            
            'salesChartLabels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'salesChartData' => [12, 19, 3, 5, 2, 3]
        ];

        return view('admin.dashboard', $data);
    }
}
