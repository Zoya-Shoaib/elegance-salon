<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function insert(Request $request)
    {
        
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'category'     => 'required|string|max:255',
            'description'  => 'required|string',
            'base_price'   => 'required|numeric|min:0',
            'product_id_1' => 'nullable|integer',
            'product_id_2' => 'nullable|integer',
            'product_id_3' => 'nullable|integer',
        ]);
        $productIds = array_filter([
        $request->product_id_1,
        $request->product_id_2,
        $request->product_id_3,
    ]);

    // 3. Query the DB to sum the prices of the selected service IDs
    // Assuming your column in the services table is named 'price'
    $totalPrice = Inventory::whereIn('id', $productIds)->sum('cost_per_unit');
    $totalPrice+=$request->base_price;
    // 4. Add total_price to the validated array
    $validated['total_price'] = $totalPrice;
       
        Service::create($validated);

        return redirect()->back()->with('success', 'Service created successfully!');
    }
}