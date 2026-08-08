<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Models\Appointments;
use Carbon\Carbon;

class StylistController extends Controller
{
    function myWork(){
        $user = Auth::user();
        
        // Fetch the stylist that matches the logged-in user's email
        $stylist = Staff::where('email', $user->email)->first();

        // Fallback for testing if staff record isn't linked properly
        if (!$stylist) {
            $stylist = Staff::where('role', 'stylist')->first();
        }

        $appointments = [];
        $todayCommission = 0;
        $weekCommission = 0;

        if ($stylist) {
            $appointments = Appointments::with(['client', 'service1'])
                ->where('stylist_id', $stylist->id)
                ->orderBy('appointment_date', 'asc')
                ->get();

            foreach ($appointments as $apt) {
                if ($apt->service1) {
                    $todayCommission += $apt->service1->total_price * ($stylist->commission_rate / 100);
                }
            }

            $weekCommission = $stylist->total_sales * ($stylist->commission_rate / 100);
        }

        return view('stylist-portal.stylist-work', compact('stylist', 'appointments', 'todayCommission', 'weekCommission'));
    }
}
