<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Client;
use App\Models\Staff;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    
        public function index()
{
    // Write the function names defined in the Appointments model
    $appointments = Appointments::with([
        'client',   // refers to public function client()
        'stylist',  // refers to public function stylist()
        'service1', // refers to public function service1()
        'service2', // refers to public function service2()
        'service3'  // refers to public function service3()
    ])->get();
$clients=Client::all();
$services=Service::all();
$staff=Staff::all();

    return view('admin.index', compact('appointments','clients','services','staff'));
}

      
    public function store(Request $request)
    {
        // 1. Validate incoming data
        $validated = $request->validate([
            'client_id'        => 'required|integer',
            'stylist_id'       => 'nullable|integer',
            'service_id_1'     => 'required|integer', // At least 1 service required
            'service_id_2'     => 'nullable|integer',
            'service_id_3'     => 'nullable|integer',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        // 2. Insert into database using the $validated variable
        Appointments::create($validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment Created Successfully');
    }

    public function update(Request $request, $id)
    {
        // 1. Validate updated data
        $validated = $request->validate([
            'client_id'        => 'required|integer',
            'stylist_id'       => 'nullable|integer',
            'service_id_1'     => 'required|integer',
            'service_id_2'     => 'nullable|integer',
            'service_id_3'     => 'nullable|integer',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        // 2. Find and update record
        $appointment = Appointments::findOrFail($id);
        $appointment->update($validated);

        return redirect()->back()->with('success', 'Appointment Updated Successfully');
    } 

    public function destroy($id)
    {
        $appointment = Appointments::findOrFail($id);
        $appointment->delete();

        return redirect()->back()->with('success', 'Appointment Deleted Successfully');
    }
}