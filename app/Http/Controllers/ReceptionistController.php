<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\Client;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Orders;
use Carbon\Carbon;

class ReceptionistController extends Controller
{
    function dashboard(){
        $today = Carbon::today();
        
        $todayAppointments = Appointments::with(['client', 'stylist', 'service1'])
            ->whereDate('appointment_date', $today)
            ->get();
            
        $totalBookings = $todayAppointments->count();
        $completedBookings = $todayAppointments->where('status', 'completed')->count();
        $pendingBookings = $todayAppointments->whereIn('status', ['scheduled', 'pending'])->count();

        return view('receptionist.dashboard', compact('todayAppointments', 'totalBookings', 'completedBookings', 'pendingBookings'));
    }
    
    function clients(){
        $clients = Client::all();
        return view('receptionist.clients', compact('clients'));
    }
    
    function pos_checkout(){
        $services = Service::all();
        $clients = Client::all();
        $staff = Staff::where('role', 'stylist')->get();
        return view('receptionist.pos-checkout', compact('services', 'clients', 'staff'));
    }
    
    function schedular(Request $request){
        $selectedDate = $request->get('date') ? Carbon::parse($request->get('date')) : Carbon::today();
        $startOfWeek = $selectedDate->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $selectedDate->copy()->endOfWeek(Carbon::SUNDAY);

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

        $appointments = Appointments::with(['client', 'stylist', 'service1'])
            ->whereBetween('appointment_date', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')])
            ->get();

        $gridAppointments = [];
        foreach ($appointments as $apt) {
            $dayIndex = Carbon::parse($apt->appointment_date)->dayOfWeekIso - 1; 
            
            $time = Carbon::parse($apt->appointment_time);
            $startHour = $time->format('G') + ($time->format('i') / 60);
            
            $topPx = max(0, ($startHour - 9) * 80);
            $heightPx = 1 * 80;

            $gridAppointments[] = [
                'id' => $apt->id,
                'day_index' => $dayIndex,
                'top_px' => $topPx,
                'height_px' => $heightPx,
                'client_name' => $apt->client->name ?? $apt->client->full_name ?? 'N/A',
                'stylist_name' => $apt->stylist->name ?? $apt->stylist->full_name ?? 'N/A',
                'service_name' => $apt->service1->name ?? 'Service',
                'time_formatted' => $time->format('g:i A'),
                'client_id' => $apt->client_id,
                'stylist_id' => $apt->stylist_id,
                'service_id_1' => $apt->service_id_1,
                'date' => $apt->appointment_date,
                'time' => $apt->appointment_time,
            ];
        }

        $clients = Client::all();
        $staff = Staff::all();
        $services = Service::all();

        return view('receptionist.schedular', compact('selectedDate', 'weekDays', 'gridAppointments', 'clients', 'staff', 'services'));
    }
}
