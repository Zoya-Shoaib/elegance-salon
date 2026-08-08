<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->id }} - Elegance Salon</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Hanken+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
        }
        body { font-family: 'Hanken Grotesk', sans-serif; }
        h1, h2, h3, .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-10">

<div class="bg-white w-full max-w-3xl rounded-xl shadow-xl overflow-hidden border border-gray-200">
    <!-- Invoice Header -->
    <div class="bg-[#2D3A3A] text-white p-8 flex justify-between items-center">
        <div>
            <div class="font-serif text-3xl font-bold flex items-center gap-2 mb-1">
                <i class="fas fa-gem text-[#C9A26A]"></i> Elegance
            </div>
            <p class="text-gray-300 text-sm">Luxury Boutique Salon</p>
        </div>
        <div class="text-right">
            <h1 class="text-4xl font-serif text-[#C9A26A] mb-1">INVOICE</h1>
            <p class="text-gray-300 font-bold tracking-widest text-sm">#INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>

    <!-- Invoice Details -->
    <div class="p-8">
        <div class="flex justify-between mb-10 border-b pb-8 border-gray-200">
            <!-- Salon Info -->
            <div class="text-sm text-gray-600 space-y-1">
                <p class="font-bold text-gray-800 text-base mb-2">Elegance Salon</p>
                <p>123 Luxury Avenue</p>
                <p>Beverly Hills, CA 90210</p>
                <p>+92 (21) 111-222-333</p>
                <p>contact@elegance.com</p>
            </div>
            
            <!-- Client & Order Info -->
            <div class="text-right text-sm text-gray-600 space-y-1">
                <p class="font-bold text-gray-800 text-base mb-2">Bill To:</p>
                <p class="font-semibold text-gray-700">{{ $order->client->full_name ?? $order->client->name ?? 'Walk-in Client' }}</p>
                @if(isset($order->client->phone))<p>{{ $order->client->phone }}</p>@endif
                <div class="mt-4 pt-2">
                    <p><span class="font-semibold">Date:</span> {{ $order->created_at->format('M d, Y') }}</p>
                    <p><span class="font-semibold">Stylist:</span> {{ $order->stylist->full_name ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Services Table -->
        <table class="w-full text-left mb-8 border-collapse">
            <thead>
                <tr class="border-b-2 border-[#2D3A3A] text-gray-800">
                    <th class="py-3 font-semibold uppercase text-xs tracking-wider">Service Description</th>
                    <th class="py-3 font-semibold uppercase text-xs tracking-wider text-right">Price</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($services as $service)
                <tr class="border-b border-gray-100">
                    <td class="py-4">
                        <p class="font-bold text-gray-800">{{ $service->name }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $service->category }}</p>
                    </td>
                    <td class="py-4 text-right font-medium text-gray-700">
                        ${{ number_format($service->total_price ?? $service->base_price, 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="flex justify-end border-t-2 border-[#2D3A3A] pt-4">
            <div class="w-1/2 md:w-1/3">
                <div class="flex justify-between font-bold text-xl text-[#2D3A3A]">
                    <span>Total:</span>
                    <span>${{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Footer Notes -->
        <div class="mt-16 text-center text-gray-500 text-sm">
            <p class="font-serif italic text-lg text-gray-800 mb-2">Thank you for your business!</p>
            <p>We hope to see you again soon at Elegance Salon.</p>
        </div>
    </div>

    <!-- Actions (Not printed) -->
    <div class="bg-gray-50 p-6 flex justify-center gap-4 no-print border-t border-gray-200">
        <button onclick="window.print()" class="bg-[#2D3A3A] hover:bg-black text-white px-6 py-2 rounded-lg font-bold transition-colors shadow-md flex items-center gap-2">
            <i class="fas fa-print"></i> Print Invoice
        </button>
        <a href="{{ route('admin.posCheckout') }}" class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-800 px-6 py-2 rounded-lg font-bold transition-colors shadow-sm flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back to POS
        </a>
    </div>
</div>

</body>
</html>
