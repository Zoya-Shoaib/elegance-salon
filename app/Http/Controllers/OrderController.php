<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function insert(Request $request)
    {
        
        $validated = $request->validate([
            'client_id'    => 'required|integer',
            'staff_id'     => 'required|integer',
            'service_id_1' => 'required|integer', 
            'service_id_2' => 'nullable|integer',
            'service_id_3' => 'nullable|integer',
            'total_amount' => 'required|numeric',
        ]);

        
        Orders::create($validated);

        return redirect()->back()->with('success', 'Order created successfully!');
    }
}