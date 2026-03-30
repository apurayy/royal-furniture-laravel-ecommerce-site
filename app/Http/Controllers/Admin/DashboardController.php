<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Contact;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Order::where('payment_status', 'paid')->sum('total');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();
        
        $recentOrders = Order::with('user')->latest()->take(10)->get();
        $lowStockProducts = Product::where('stock_quantity', '<', 10)->take(5)->get();
        
        $ordersByStatus = [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];
        
        return view('admin.dashboard.index', compact(
            'totalSales', 'totalOrders', 'totalProducts', 'totalCustomers',
            'recentOrders', 'lowStockProducts', 'ordersByStatus'
        ));
    }

    public function login()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome back!');
            }
            auth()->logout();
        }

        return back()->with('error', 'Invalid credentials or not an admin.');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
