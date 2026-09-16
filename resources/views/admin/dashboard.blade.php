@extends('admin.layouts.admin_layout')
@section('content')

    <!-- Top Notification Toast (Dynamic Low Inventory Alert) -->
    @if(isset($lowStockCount) && $lowStockCount > 0)
      <div class="absolute top-24 left-1/2 transform -translate-x-1/2 z-50 bg-[#FFF5F5] border-l-4 border-[#F87171] shadow-xl rounded-r-lg p-3 min-w-[400px] flex gap-3 items-center">
        <span class="material-symbols-outlined text-[#991B1B]">warning</span>
        <div class="text-sm">
          <span class="font-bold text-[#991B1B] block">Low Inventory Alert</span>
          <span class="text-gray-700">{{ $lowStockCount }} items in inventory are running low on stock.</span>
        </div>
      </div>
    @endif
    
    <!-- Content Area -->
    <div class="flex-grow p-8 overflow-y-auto scrollbar-lux">
      <div class="mb-8">
        <h2 class="font-serif text-3xl font-bold text-primary">Salon Performance Overview</h2>
        <p class="text-sm text-gray-500">Live analytics and operational summary for today.</p>
      </div>

      <!-- Metric Cards Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Metric 1: Today's Revenue -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Total Revenue</span>
            <h3 class="text-2xl font-bold text-primary">${{ number_format($totalRevenue ?? 0, 2) }}</h3>
            <span class="text-xs text-green-600 font-semibold flex items-center gap-1">
              <i class="fas fa-arrow-up"></i> Live DB Sync
            </span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">monetization_on</span>
          </div>
        </div>

        <!-- Metric 2: Appointments Booked -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Appointments Booked</span>
            <h3 class="text-2xl font-bold text-primary">{{ $totalBookings ?? 0 }}</h3>
            <span class="text-xs text-green-600 font-semibold flex items-center gap-1">
              <i class="fas fa-check-circle"></i> Total Orders
            </span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">event_available</span>
          </div>
        </div>

        <!-- Metric 3: Active Stylists -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Active Stylists</span>
            <h3 class="text-2xl font-bold text-primary">{{ $activeStaffCount ?? $stylists->count() ?? 0 }}</h3>
            <span class="text-xs text-gray-400 font-semibold truncate block w-32">On Roster</span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">person_pin</span>
          </div>
        </div>

        <!-- Metric 4: Low Inventory Alerts -->
        <div class="bg-surface border-2 border-secondary/50 rounded-2xl p-6 shadow-lg flex items-center justify-between bg-gradient-to-r from-surface to-background">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Low Inventory Alerts</span>
            <h3 class="text-2xl font-bold text-secondary">{{ $lowStockCount ?? 0 }} Items</h3>
            <span class="text-xs text-red-500 font-semibold flex items-center gap-1">
              <i class="fas fa-exclamation-triangle"></i> Action required
            </span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">inventory_2</span>
          </div>
        </div>
      </div>

      <!-- Charts & Tables Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Weekly Revenue Trends -->
        <div class="lg:col-span-2 bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg">
          <div class="flex justify-between items-center mb-6">
            <h4 class="font-serif text-lg font-bold text-primary">Weekly Revenue Trends</h4>
            <span class="bg-background border border-secondary/30 text-gray-600 text-xs px-3 py-1 rounded-full font-semibold">Live Performance</span>
          </div>
          <div class="h-64 w-full flex items-end justify-between gap-2 px-2 relative border-b border-l border-gray-200 pb-2">
            <!-- Y-Axis Labels -->
            <div class="absolute -left-8 top-0 h-full flex flex-col justify-between text-[10px] text-gray-400">
              <span>Max</span>
              <span>Mid</span>
              <span>Low</span>
              <span>$0</span>
            </div>
            <!-- Static SVG Line Chart Overlay -->
            <svg class="absolute inset-0 w-full h-full p-2 pb-3 pl-1" preserveAspectRatio="none" viewBox="0 0 100 100">
              <line x1="0" y1="25" x2="100" y2="25" stroke="#E5E7EB" stroke-width="0.5" stroke-dasharray="2,2"></line>
              <line x1="0" y1="50" x2="100" y2="50" stroke="#E5E7EB" stroke-width="0.5" stroke-dasharray="2,2"></line>
              <line x1="0" y1="75" x2="100" y2="75" stroke="#E5E7EB" stroke-width="0.5" stroke-dasharray="2,2"></line>
              <polyline points="5,80 20,60 35,40 50,70 65,30 80,45 95,20" fill="none" stroke="#D4AF37" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
              <polygon points="5,100 5,80 20,60 35,40 50,70 65,30 80,45 95,20 95,100" fill="rgba(212, 175, 55, 0.1)"></polygon>
            </svg>
            <!-- X-Axis Labels -->
            <div class="absolute -bottom-6 left-0 w-full flex justify-between text-[10px] text-gray-400 font-bold px-2">
              <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
            </div>
          </div>
        </div>

        <!-- Popular Services Breakdown -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex flex-col">
          <h4 class="font-serif text-lg font-bold text-primary mb-4">Popular Services</h4>
          <div class="flex-grow flex flex-col items-center justify-between">
            <div class="w-full space-y-3 mt-2">
              @forelse($serviceBreakdown ?? [] as $service)
                <div>
                  <div class="flex justify-between items-center text-xs font-semibold mb-1">
                    <span class="text-primary font-bold">{{ $service->name }}</span>
                    <span>{{ $service->percentage }}%</span>
                  </div>
                  <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-secondary h-full rounded-full" style="width: {{ $service->percentage }}%"></div>
                  </div>
                </div>
              @empty
                <p class="text-xs text-gray-400 text-center py-6">No service sales recorded.</p>
              @endforelse
            </div>
          </div>
        </div>
      </div>

      <!-- Live Salon Queue Tracker & Peak Hours -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Appointments Table -->
        <div class="lg:col-span-2 bg-surface border border-secondary/20 rounded-2xl p-0 shadow-lg overflow-hidden">
          <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-background/50">
            <h4 class="font-serif text-lg font-bold text-primary">Recent Scheduled Appointments</h4>
            <span class="bg-primary/10 text-primary text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Live Queue</span>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
              <thead>
                <tr class="bg-[#FAF8F3]/50 text-[10px] uppercase tracking-wider text-gray-500 border-b border-gray-100">
                  <th class="p-4 font-bold">Client Name</th>
                  <th class="p-4 font-bold">Scheduled Stylist</th>
                  <th class="p-4 font-bold">Service Booked</th>
                  <th class="p-4 font-bold">Time Slot</th>
                  <th class="p-4 font-bold">Status</th>
                </tr>
              </thead>
              <tbody class="text-sm divide-y divide-gray-50 font-sans">
                @forelse($appointments ?? [] as $appointment)
                  <tr class="hover:bg-gray-50/50">
                    <td class="p-4 font-semibold text-primary">
                      {{ $appointment->client->full_name ?? $appointment->client->name ?? 'Guest Client' }}
                    </td>
                    <td class="p-4 text-gray-600">
                      {{ $appointment->staff->full_name ?? 'Unassigned' }}
                    </td>
                    <td class="p-4 text-gray-600">
                      {{ $appointment->service->name ?? 'General Service' }}
                    </td>
                    <td class="p-4 text-gray-600 font-mono">
                      {{ $appointment->appointment_time ?? $appointment->time_slot ?? '10:00 AM' }}
                    </td>
                    <td class="p-4">
                      <span class="inline-block px-2.5 py-1 bg-green-50 text-primary text-[10px] font-bold rounded-full border border-green-200">
                        {{ ucfirst($appointment->status ?? 'Scheduled') }}
                      </span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="p-4 text-center text-gray-400 text-xs">No appointments scheduled for today.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <!-- Peak Booking Hours Bar Visual -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg">
          <h4 class="font-serif text-lg font-bold text-primary mb-6">Peak Booking Hours</h4>
          <div class="h-48 w-full flex items-end justify-between gap-1 relative border-b border-gray-200 pb-2">
            <div class="w-1/6 bg-secondary/30 hover:bg-secondary transition-colors h-[30%] rounded-t-sm relative group">
              <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-500 opacity-0 group-hover:opacity-100">12</span>
            </div>
            <div class="w-1/6 bg-secondary/50 hover:bg-secondary transition-colors h-[50%] rounded-t-sm relative group">
              <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-500 opacity-0 group-hover:opacity-100">24</span>
            </div>
            <div class="w-1/6 bg-secondary hover:bg-primary transition-colors h-[90%] rounded-t-sm relative group">
              <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-500 opacity-0 group-hover:opacity-100">45</span>
            </div>
            <div class="w-1/6 bg-secondary hover:bg-primary transition-colors h-[100%] rounded-t-sm relative group">
              <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-500 opacity-0 group-hover:opacity-100">52</span>
            </div>
            <div class="w-1/6 bg-secondary/60 hover:bg-secondary transition-colors h-[60%] rounded-t-sm relative group">
              <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-500 opacity-0 group-hover:opacity-100">30</span>
            </div>
            <div class="w-1/6 bg-secondary/30 hover:bg-secondary transition-colors h-[40%] rounded-t-sm relative group">
              <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-500 opacity-0 group-hover:opacity-100">18</span>
            </div>
            <!-- X-Axis -->
            <div class="absolute -bottom-6 left-0 w-full flex justify-between text-[9px] text-gray-400 font-bold px-1">
              <span>9A</span><span>11A</span><span>1P</span><span>3P</span><span>5P</span><span>7P</span>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection