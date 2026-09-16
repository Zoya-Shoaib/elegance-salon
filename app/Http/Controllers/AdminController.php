<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Appointments;
use App\Models\Service;
use App\Models\Inventory;
use App\Models\Client;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Core Metrics Data
        $totalRevenue = Orders::sum('total_amount');
        $totalBookings = Orders::count();
        $lowStockCount = DB::table('inventories')->where('stock_level', '<=', 5)->count();
        $activeStaffCount = Staff::count();

        // 2. Recent Appointments with Model Relationships ('stylist' and 'service1')
        $appointments = Appointments::with(['client', 'stylist', 'service1'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalBookings',
            'lowStockCount',
            'activeStaffCount',
            'appointments'
        ));
    }
    function analytics()
    {


        // 1. KPI Cards Data
        $totalRevenue = Orders::sum('total_amount');
        $totalBookings = Orders::count();

        // Inventory Metrics (using 'stock_level' and 'coat_per_unit')
        $inventoryValue = DB::table('inventories')->sum(DB::raw('cost_per_unit * stock_level'));
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
            ->map(function ($service) use ($totalServicesCount) {
                $service->percentage = $totalServicesCount > 0
                    ? round(($service->count / $totalServicesCount) * 100)
                    : 0;
                return $service;
            });

        return view('admin.analytics', compact(
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
    function inventory()
    {
        return view('admin.inventory');
    }
    function pos_checkout()
    {
        $services = Service::all();
        $clients = Client::all();
        $staff = Staff::all();

        return view('admin.pos-checkout', compact('services', 'clients', 'staff'));
    }
    public function schedular(Request $request)
    {
        // 1. Current Selected Date / Start & End of Week
        $selectedDate = $request->get('date') ? Carbon::parse($request->get('date')) : Carbon::today();
        $startOfWeek = $selectedDate->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $selectedDate->copy()->endOfWeek(Carbon::SUNDAY);

        // 2. Dynamic Days Array for Grid Header
        $weekDays = [];
        for ($i = 0; $i < 7; $i++) {
            $day = $startOfWeek->copy()->addDays($i);
            $weekDays[] = [
                'name' => $day->format('D'),
                'date_num' => $day->format('d'),
                'full_date' => $day->format('Y-m-d'),
                'is_today' => $day->isToday(),
            ];
        }

        // 3. Fetch Weekly Appointments with Relations
        $appointments = Appointments::with(['client', 'stylist', 'service1'])
            ->whereBetween('appointment_date', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')])
            ->get();

        // 4. Calculate Grid Layout Positions
        $gridAppointments = $appointments->map(function ($apt) use ($startOfWeek) {
            $aptDate = Carbon::parse($apt->appointment_date);
            $dayIndex = $startOfWeek->diffInDays($aptDate);

            $time = Carbon::parse($apt->appointment_time);
            $startHour = 9; // Grid starts at 9:00 AM

            $minutesFromStart = ($time->hour - $startHour) * 60 + $time->minute;
            $topPx = max(0, ($minutesFromStart / 60) * 80);
            $heightPx = 80;

            return [
                'id' => $apt->id,
                'client_name' => $apt->client->name ?? $apt->client->full_name ?? 'Client',
                'stylist_name' => $apt->stylist->full_name ?? $apt->stylist->name ?? 'Stylist',
                'service_name' => $apt->service1->name ?? 'Service',
                'time_formatted' => $time->format('g:i A'),
                'day_index' => $dayIndex,
                'top_px' => $topPx,
                'height_px' => $heightPx,
                'client_id' => $apt->client_id,
                'stylist_id' => $apt->stylist_id,
                'service_id_1' => $apt->service_id_1,
                'service_id_2' => $apt->service_id_2,
                'service_id_3' => $apt->service_id_3,
                'date' => $apt->appointment_date,
                'time' => $apt->appointment_time,
            ];
        });

        // 5. Dropdown Options Data
        $clients = Client::all();
        $staff = Staff::all();
        $services = Service::all();

        // View me COMPACT ke zariye $selectedDate pass ho raha hai
        return view('admin.schedular', compact(
            'weekDays',
            'gridAppointments',
            'selectedDate',
            'clients',
            'staff',
            'services'
        ));
    }
    function staff()
    {
        $staff = Staff::all();

        return view('admin.staff', compact('staff'));
    }
    function services()
    {
        $products = Inventory::all();
        return view('admin.services', compact('products'));
    }
}
