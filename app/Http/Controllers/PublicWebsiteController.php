<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Orders;
use App\Models\Appointments;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PublicWebsiteController extends Controller
{
    function index()
    {
        // 1. Hero Metrics
        $todayAppointments = Appointments::whereDate('appointment_date', Carbon::today())->count();
        $activeStylists = Staff::where('role', 'stylist')->count();
        
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $monthlyClients = Appointments::where('appointment_date', '>=', $firstDayOfMonth)
                                    ->distinct('client_id')
                                    ->count('client_id');
        
        $revenueToday = Orders::whereDate('created_at', Carbon::today())->sum('total_amount');

        // Customer Satisfaction - fetch average rating from Feedback (default 98% if no feedback)
        $avgFeedback = DB::table('feedback')->avg('rating') ?? 4.9;
        $satisfactionPercentage = min(100, round(($avgFeedback / 5) * 100));

        // 2. Services List
        $services = Service::all();

        // 3. Stylists List
        $stylists = Staff::where('role', 'stylist')->get();

        return view('public-web.index', compact(
            'todayAppointments',
            'activeStylists',
            'monthlyClients',
            'revenueToday',
            'satisfactionPercentage',
            'services',
            'stylists'
        ));
    }
}
