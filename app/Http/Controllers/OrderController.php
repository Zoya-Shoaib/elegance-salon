<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Service;
use App\Models\Inventory;
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

        
        $order = Orders::create($validated);

        // Decrement products used in the ordered services
        $serviceIds = array_filter([$order->service_id_1, $order->service_id_2, $order->service_id_3]);
        if (!empty($serviceIds)) {
            $services = Service::whereIn('id', $serviceIds)->get();
            foreach ($services as $service) {
                $productIds = array_filter([$service->product_id_1, $service->product_id_2, $service->product_id_3]);
                if (!empty($productIds)) {
                    Inventory::whereIn('id', $productIds)->where('stock_level', '>', 0)->decrement('stock_level', 1);
                }
            }
        }

        return redirect()->route('invoice.show', $order->id)->with('success', 'Order created successfully!');
    }

    public function showInvoice($id)
    {
        $order = Orders::with(['client', 'stylist'])->findOrFail($id);
        
        // Fetch services manually since relationships might not be defined in Orders model
        $serviceIds = array_filter([$order->service_id_1, $order->service_id_2, $order->service_id_3]);
        $services = \App\Models\Service::whereIn('id', $serviceIds)->get();

        return view('admin.invoice', compact('order', 'services'));
    }
}