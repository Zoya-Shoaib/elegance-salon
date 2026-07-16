@extends('admin.layouts.admin_layout')
@section('content')
 
    <!-- Top Notification Toast (Static) -->
    <div class="absolute top-24 left-1/2 transform -translate-x-1/2 z-50 bg-[#FFF5F5] border-l-4 border-[#F87171] shadow-xl rounded-r-lg p-3 min-w-[400px] flex gap-3 items-center">
      <span class="material-symbols-outlined text-[#991B1B]">warning</span>
      <div class="text-sm">
        <span class="font-bold text-[#991B1B] block">Low Inventory Alert</span>
        <span class="text-gray-700">Keratin Treatment Kits are running critically low (2 remaining).</span>
      </div>
    </div>
    
    <!-- Content Area -->
    <div class="flex-grow p-8 overflow-y-auto scrollbar-lux">
      <div class="mb-8">
        <h2 class="font-serif text-3xl font-bold text-primary">Salon Performance Overview</h2>
        <p class="text-sm text-gray-500">Live analytics and operational summary for today.</p>
      </div>
      <!-- Metric Cards Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Metric 1 -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Today's Revenue</span>
            <h3 class="text-2xl font-bold text-primary">$1,450.00</h3>
            <span class="text-xs text-green-600 font-semibold flex items-center gap-1"><i class="fas fa-arrow-up"></i> +12.4%</span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">monetization_on</span>
          </div>
        </div>
        <!-- Metric 2 -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Appointments Booked</span>
            <h3 class="text-2xl font-bold text-primary">24</h3>
            <span class="text-xs text-green-600 font-semibold flex items-center gap-1"><i class="fas fa-arrow-up"></i> +4.2%</span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">event_available</span>
          </div>
        </div>
        <!-- Metric 3 -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Active Stylists</span>
            <h3 class="text-2xl font-bold text-primary">5 / 6</h3>
            <span class="text-xs text-gray-400 font-semibold truncate block w-32">On Duty Today</span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">person_pin</span>
          </div>
        </div>
        <!-- Metric 4 -->
        <div class="bg-surface border-2 border-secondary/50 rounded-2xl p-6 shadow-lg flex items-center justify-between bg-gradient-to-r from-surface to-background">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Low Inventory Alerts</span>
            <h3 class="text-2xl font-bold text-secondary">3 Items</h3>
            <span class="text-xs text-red-500 font-semibold flex items-center gap-1"><i class="fas fa-exclamation-triangle"></i> Action required</span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">inventory_2</span>
          </div>
        </div>
      </div>
      <!-- Charts & Tables Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Weekly Revenue Trends (Line Chart Placeholder using SVG) -->
        <div class="lg:col-span-2 bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg">
          <div class="flex justify-between items-center mb-6">
            <h4 class="font-serif text-lg font-bold text-primary">Weekly Revenue Trends</h4>
            <span class="bg-background border border-secondary/30 text-gray-600 text-xs px-3 py-1 rounded-full font-semibold">Last 7 Days</span>
          </div>
          <div class="h-64 w-full flex items-end justify-between gap-2 px-2 relative border-b border-l border-gray-200 pb-2">
            <!-- Y-Axis Labels -->
            <div class="absolute -left-8 top-0 h-full flex flex-col justify-between text-[10px] text-gray-400">
              <span>$3k</span>
              <span>$2k</span>
              <span>$1k</span>
              <span>$0</span>
            </div>
            <!-- Static SVG Line Chart Overlay -->
            <svg class="absolute inset-0 w-full h-full p-2 pb-3 pl-1" preserveAspectRatio="none" viewBox="0 0 100 100">
              <!-- Grid lines -->
              <line x1="0" y1="25" x2="100" y2="25" stroke="#E5E7EB" stroke-width="0.5" stroke-dasharray="2,2"></line>
              <line x1="0" y1="50" x2="100" y2="50" stroke="#E5E7EB" stroke-width="0.5" stroke-dasharray="2,2"></line>
              <line x1="0" y1="75" x2="100" y2="75" stroke="#E5E7EB" stroke-width="0.5" stroke-dasharray="2,2"></line>
              <!-- Data Line -->
              <polyline points="5,80 20,60 35,40 50,70 65,30 80,45 95,20" fill="none" stroke="#D4AF37" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
              <!-- Fill Gradient -->
              <polygon points="5,100 5,80 20,60 35,40 50,70 65,30 80,45 95,20 95,100" fill="rgba(212, 175, 55, 0.1)"></polygon>
            </svg>
            <!-- X-Axis Labels -->
            <div class="absolute -bottom-6 left-0 w-full flex justify-between text-[10px] text-gray-400 font-bold px-2">
              <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
            </div>
          </div>
        </div>
        <!-- Popular Services (Donut Chart visual via SVG) -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex flex-col">
          <h4 class="font-serif text-lg font-bold text-primary mb-6">Popular Services</h4>
          <div class="flex-grow flex flex-col items-center justify-center">
            <div class="relative w-40 h-40 mb-6">
              <svg viewBox="0 0 36 36" class="w-full h-full drop-shadow-md">
                <!-- Background Circle -->
                <path class="text-gray-100" stroke-width="4" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                <!-- Hair Styling (45%) -->
                <path class="text-primary" stroke-dasharray="45, 100" stroke-width="4" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                <!-- Facials (30%) -->
                <path class="text-secondary" stroke-dasharray="30, 100" stroke-dashoffset="-45" stroke-width="4" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                <!-- Manicures (25%) -->
                <path class="text-[#072E21]" stroke-dasharray="25, 100" stroke-dashoffset="-75" stroke-width="4" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
              </svg>
              <!-- Center Text -->
              <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                <span class="text-xs text-gray-500 font-bold">Total</span>
                <span class="text-xl font-bold text-primary">124</span>
              </div>
            </div>
            <!-- Legend -->
            <div class="w-full space-y-2 text-xs">
              <div class="flex justify-between items-center"><div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-primary"></div><span>Hair Styling</span></div><span class="font-bold">45%</span></div>
              <div class="flex justify-between items-center"><div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-secondary"></div><span>Facials</span></div><span class="font-bold">30%</span></div>
              <div class="flex justify-between items-center"><div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#072E21]"></div><span>Manicures</span></div><span class="font-bold">25%</span></div>
            </div>
          </div>
        </div>
      </div>
      <!-- Live Salon Queue Tracker & Peak Hours -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Today's Appointments Table -->
        <div class="lg:col-span-2 bg-surface border border-secondary/20 rounded-2xl p-0 shadow-lg overflow-hidden">
          <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-background/50">
            <h4 class="font-serif text-lg font-bold text-primary">Recent Today's Appointments</h4>
            <span class="bg-primary/10 text-primary text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Daily Schedule</span>
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
                <tr class="hover:bg-gray-50/50">
                  <td class="p-4 font-semibold text-primary">Jessica Miller</td>
                  <td class="p-4 text-gray-600">Marcus</td>
                  <td class="p-4 text-gray-600">Hair styling</td>
                  <td class="p-4 text-gray-600 font-mono">10:00 AM</td>
                  <td class="p-4">
                    <span class="inline-block px-2.5 py-1 bg-green-50 text-primary text-[10px] font-bold rounded-full border border-green-200">Scheduled</span>
                  </td>
                </tr>
                <tr class="hover:bg-gray-50/50">
                  <td class="p-4 font-semibold text-primary">Sarah Khan</td>
                  <td class="p-4 text-gray-600">David</td>
                  <td class="p-4 text-gray-600">Hydrafacial</td>
                  <td class="p-4 text-gray-600 font-mono">11:30 AM</td>
                  <td class="p-4">
                    <span class="inline-block px-2.5 py-1 bg-green-50 text-primary text-[10px] font-bold rounded-full border border-green-200">Scheduled</span>
                  </td>
                </tr>
                <tr class="hover:bg-gray-50/50">
                  <td class="p-4 font-semibold text-primary">Emma Watson</td>
                  <td class="p-4 text-gray-600">Sophia</td>
                  <td class="p-4 text-gray-600">Manicure</td>
                  <td class="p-4 text-gray-600 font-mono">02:00 PM</td>
                  <td class="p-4">
                    <span class="inline-block px-2.5 py-1 bg-green-50 text-primary text-[10px] font-bold rounded-full border border-green-200">Scheduled</span>
                  </td>
                </tr>
                <tr class="hover:bg-gray-50/50">
                  <td class="p-4 font-semibold text-primary">Isabella Swan</td>
                  <td class="p-4 text-gray-600">Clarissa Gold</td>
                  <td class="p-4 text-gray-600">Balayage Color</td>
                  <td class="p-4 text-gray-600 font-mono">03:30 PM</td>
                  <td class="p-4">
                    <span class="inline-block px-2.5 py-1 bg-amber-50 text-secondary-dark text-[10px] font-bold rounded-full border border-amber-200">Confirmed</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Peak Booking Hours (Bar Chart visual via SVG) -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg">
          <h4 class="font-serif text-lg font-bold text-primary mb-6">Peak Booking Hours</h4>
          <div class="h-48 w-full flex items-end justify-between gap-1 relative border-b border-gray-200 pb-2">
            <!-- Static Bar Chart -->
            <div class="w-1/6 bg-secondary/30 hover:bg-secondary transition-colors h-[30%] rounded-t-sm relative group"><span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-500 opacity-0 group-hover:opacity-100">12</span></div>
            <div class="w-1/6 bg-secondary/50 hover:bg-secondary transition-colors h-[50%] rounded-t-sm relative group"><span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-500 opacity-0 group-hover:opacity-100">24</span></div>
            <div class="w-1/6 bg-secondary hover:bg-primary transition-colors h-[90%] rounded-t-sm relative group"><span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-500 opacity-0 group-hover:opacity-100">45</span></div>
            <div class="w-1/6 bg-secondary hover:bg-primary transition-colors h-[100%] rounded-t-sm relative group"><span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-500 opacity-0 group-hover:opacity-100">52</span></div>
            <div class="w-1/6 bg-secondary/60 hover:bg-secondary transition-colors h-[60%] rounded-t-sm relative group"><span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-500 opacity-0 group-hover:opacity-100">30</span></div>
            <div class="w-1/6 bg-secondary/30 hover:bg-secondary transition-colors h-[40%] rounded-t-sm relative group"><span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-500 opacity-0 group-hover:opacity-100">18</span></div>
            <!-- X-Axis -->
            <div class="absolute -bottom-6 left-0 w-full flex justify-between text-[9px] text-gray-400 font-bold px-1">
              <span>9A</span><span>11A</span><span>1P</span><span>3P</span><span>5P</span><span>7P</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>



@endsection