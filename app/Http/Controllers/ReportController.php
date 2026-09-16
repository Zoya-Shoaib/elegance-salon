<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Staff; 
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // 1. KPI Cards Data
        $totalRevenue = Orders::sum('total_amount');
        $totalBookings = Orders::count();
        
        // Inventory Metrics (using 'stock_level' and 'coat_per_unit')
        $inventoryValue = DB::table('inventories')->sum(DB::raw('coat_per_unit * stock_level'));
        $lowStockCount = DB::table('inventories')->where('stock_level', '<=', 5)->count();

        // Top Stylist
        $topStylist = Staff::first();

        // 2. Stylist Performance & Commission Table (Using 'full_name' and DB 'commission_rate')
        $stylists = Staff::select('staff.*')
            ->selectRaw('COUNT(orders.id) as services_count')
            ->selectRaw('COALESCE(SUM(orders.total_amount), 0) as total_sales')
            ->leftJoin('orders', 'staff.id', '=', 'orders.staff_id')
            ->groupBy('staff.id')
            ->get();

        // 3. Inventory Usage Trends Table
        $inventoryItems = Inventory::take(5)->get();

        // 4. Service Popularity Percentage Breakdown
        $totalServicesCount = Orders::count();
        $serviceBreakdown = DB::table('orders')
            ->join('services', 'orders.service_id_1', '=', 'services.id')
            ->select('services.name', DB::raw('count(*) as count'))
            ->groupBy('services.id', 'services.name')
            ->get()
            ->map(function($service) use ($totalServicesCount) {
                $service->percentage = $totalServicesCount > 0 
                    ? round(($service->count / $totalServicesCount) * 100) 
                    : 0;
                return $service;
            });

        return view('admin.reports.index', compact(
            'totalRevenue',
            'totalBookings',
            'inventoryValue',
            'lowStockCount',
            'topStylist',
            'stylists',
            'inventoryItems',
            'serviceBreakdown'
        ));
    }
}