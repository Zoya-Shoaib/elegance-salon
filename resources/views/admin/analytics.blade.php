@extends('admin.layouts.admin_layout')
@section('content')
  
    <!-- Content Area -->
    <div class="flex-grow p-8 overflow-y-auto scrollbar-lux">
      <!-- Top Filter & Date Selector Bar -->
      <div class="bg-surface border border-secondary/20 rounded-2xl p-4 shadow-md mb-8 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3 w-full sm:w-auto">
          <span class="material-symbols-outlined text-primary">filter_alt</span>
          <span class="text-sm font-semibold text-gray-700">Filter Reports:</span>
          <select class="bg-background border border-secondary/30 rounded-lg text-sm text-gray-700 py-1.5 px-3 focus:outline-none focus:ring-1 focus:ring-primary cursor-pointer">
            <option>This Month</option>
            <option>Today</option>
            <option>This Week</option>
            <option>Custom Range</option>
          </select>
        </div>
        <button class="bg-secondary text-primary-container font-bold text-xs px-6 py-3 rounded-full hover:bg-[#EDD98A] transition-colors flex items-center justify-center gap-2 shadow-md w-full sm:w-auto" onclick="document.getElementById('exportModal').classList.remove('hidden')">
          <span class="material-symbols-outlined text-sm">download</span>
          <span>Export PDF / CSV</span>
        </button>
      </div>

      <!-- Key Performance Metrics (KPIs) -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1: Total Revenue -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Total Monthly Revenue</span>
            <h3 class="text-2xl font-bold text-primary font-sans">${{ number_format($totalRevenue ?? 0, 2) }}</h3>
            <span class="inline-flex items-center gap-0.5 text-[10px] font-bold bg-green-50 text-green-700 border border-green-200 rounded px-1.5 py-0.5">
              Live Database
            </span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">payments</span>
          </div>
        </div>

        <!-- Card 2: Total Bookings -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Total Bookings</span>
            <h3 class="text-2xl font-bold text-primary font-sans">{{ $totalBookings ?? 0 }} Appointments</h3>
            <span class="text-xs text-gray-400 font-semibold truncate block">Completed &amp; Confirmed</span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">event_note</span>
          </div>
        </div>

        <!-- Card 3: Inventory Value -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Inventory Value</span>
            <h3 class="text-2xl font-bold text-primary font-sans">${{ number_format($inventoryValue ?? 0, 2) }}</h3>
            <span class="text-xs font-semibold text-secondary flex items-center gap-1">
              <i class="fas fa-exclamation-triangle text-amber-500"></i> {{ $lowStockCount ?? 0 }} Low Stock Alerts
            </span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">inventory_2</span>
          </div>
        </div>

        <!-- Card 4: Top Performing Stylist -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Top Performing Stylist</span>
            <h3 class="text-2xl font-bold text-primary font-sans">{{ $topStylist->full_name ?? 'N/A' }}</h3>
            <span class="text-xs font-semibold text-secondary flex items-center gap-1">
              <i class="fas fa-user-tag text-[10px]"></i> {{ $topStylist->role ?? 'Lead Stylist' }}
            </span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">workspace_premium</span>
          </div>
        </div>
      </div>

      <!-- Sales & Revenue Performance (SVG Line/Bar Chart) -->
      <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg mb-8">
        <div class="flex justify-between items-center mb-6">
          <h4 class="font-serif text-xl font-bold text-primary">Monthly Sales &amp; Revenue Trends</h4>
          <span class="bg-background border border-secondary/30 text-gray-600 text-xs px-3 py-1 rounded-full font-semibold">{{ date('Y') }} Overview</span>
        </div>
        <div class="h-72 w-full flex items-end justify-between gap-2 px-2 relative border-b border-l border-gray-200 pb-2">
          <!-- Y-Axis Labels -->
          <div class="absolute -left-10 top-0 h-full flex flex-col justify-between text-[10px] text-gray-400">
            <span>Max</span>
            <span>Mid</span>
            <span>Low</span>
            <span>$0</span>
          </div>
          <!-- Static SVG Line & Bar Overlay -->
          <svg class="absolute inset-0 w-full h-full p-2 pb-3 pl-1" preserveAspectRatio="none" viewBox="0 0 100 100">
            <!-- Grid lines -->
            <line x1="0" y1="25" x2="100" y2="25" stroke="#E5E7EB" stroke-width="0.5" stroke-dasharray="2,2"></line>
            <line x1="0" y1="50" x2="100" y2="50" stroke="#E5E7EB" stroke-width="0.5" stroke-dasharray="2,2"></line>
            <line x1="0" y1="75" x2="100" y2="75" stroke="#E5E7EB" stroke-width="0.5" stroke-dasharray="2,2"></line>
            <!-- Revenue Line (Gold Accent) -->
            <polyline points="8,80 25,65 42,45 59,38 76,55 93,22" fill="none" stroke="#D4AF37" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></polyline>
            <polygon points="8,100 8,80 25,65 42,45 59,38 76,55 93,22 93,100" fill="rgba(212, 175, 55, 0.08)"></polygon>
            <!-- Bookings Trend Line (Emerald Green) -->
            <polyline points="8,90 25,78 42,55 59,50 76,68 93,35" fill="none" stroke="#0F6B50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="1,1"></polyline>
          </svg>
          <!-- Legend Overlay -->
          <div class="absolute top-2 right-4 flex items-center gap-4 text-xs font-semibold bg-white/80 p-2 rounded-lg border border-gray-100 shadow-sm z-20">
            <div class="flex items-center gap-1.5">
              <span class="h-3 w-3 bg-[#D4AF37] rounded-sm"></span>
              <span>Total Revenue</span>
            </div>
            <div class="flex items-center gap-1.5">
              <span class="h-0.5 w-4 bg-[#0F6B50] border-t border-dashed border-[#0F6B50]"></span>
              <span>Appointments</span>
            </div>
          </div>
          <!-- X-Axis Labels -->
          <div class="absolute -bottom-6 left-0 w-full flex justify-between text-[10px] text-gray-400 font-bold px-2">
            <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span>
          </div>
        </div>
      </div>

      <!-- Popular Services & Peak Booking Hours Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Left Column: Service Popularity Breakdown -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex flex-col justify-between">
          <div>
            <h4 class="font-serif text-lg font-bold text-primary mb-1">Service Popularity Breakdown</h4>
            <p class="text-xs text-gray-500 mb-6">Percentage allocation of total appointment bookings.</p>
          </div>
          <div class="w-full space-y-4">
            @forelse($serviceBreakdown as $service)
              <div>
                <div class="flex justify-between items-center text-xs font-semibold mb-1">
                  <span class="flex items-center gap-2"><span class="h-3 w-3 bg-primary rounded-full"></span>{{ $service->name }}</span>
                  <span>{{ $service->percentage }}%</span>
                </div>
                <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                  <div class="bg-primary h-full rounded-full" style="width: {{ $service->percentage }}%"></div>
                </div>
              </div>
            @empty
              <p class="text-xs text-gray-400 text-center py-4">No services booked yet.</p>
            @endforelse
          </div>
        </div>

        <!-- Right Column: Peak Booking Hours -->
        <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg flex flex-col justify-between">
          <div>
            <h4 class="font-serif text-lg font-bold text-primary mb-1">Peak Booking Hours</h4>
            <p class="text-xs text-gray-500 mb-6">Hourly appointment density indicating high traffic blocks.</p>
          </div>
          <div class="h-44 w-full flex items-end justify-between gap-3 border-b border-gray-200 pb-2 relative">
            <div class="w-12 bg-primary/20 hover:bg-primary transition-colors h-[25%] rounded-t-lg relative group flex justify-center">
              <span class="absolute -top-7 text-[10px] font-bold text-gray-500 bg-white px-1.5 py-0.5 rounded border border-gray-200 opacity-0 group-hover:opacity-100 shadow-sm transition-opacity">12%</span>
            </div>
            <div class="w-12 bg-primary/40 hover:bg-primary transition-colors h-[45%] rounded-t-lg relative group flex justify-center">
              <span class="absolute -top-7 text-[10px] font-bold text-gray-500 bg-white px-1.5 py-0.5 rounded border border-gray-200 opacity-0 group-hover:opacity-100 shadow-sm transition-opacity">22%</span>
            </div>
            <div class="w-12 bg-primary/50 hover:bg-primary transition-colors h-[60%] rounded-t-lg relative group flex justify-center">
              <span class="absolute -top-7 text-[10px] font-bold text-gray-500 bg-white px-1.5 py-0.5 rounded border border-gray-200 opacity-0 group-hover:opacity-100 shadow-sm transition-opacity">30%</span>
            </div>
            <div class="w-12 bg-secondary hover:bg-primary-container transition-colors h-[92%] rounded-t-lg relative group flex justify-center border-t-2 border-primary">
              <span class="absolute -top-7 text-[10px] font-bold text-primary-container bg-secondary px-1.5 py-0.5 rounded border border-secondary shadow-sm">Peak</span>
            </div>
            <div class="w-12 bg-secondary/80 hover:bg-primary transition-colors h-[80%] rounded-t-lg relative group flex justify-center">
              <span class="absolute -top-7 text-[10px] font-bold text-gray-500 bg-white px-1.5 py-0.5 rounded border border-gray-200 opacity-0 group-hover:opacity-100 shadow-sm transition-opacity">40%</span>
            </div>
            <div class="w-12 bg-primary/30 hover:bg-primary transition-colors h-[35%] rounded-t-lg relative group flex justify-center">
              <span class="absolute -top-7 text-[10px] font-bold text-gray-500 bg-white px-1.5 py-0.5 rounded border border-gray-200 opacity-0 group-hover:opacity-100 shadow-sm transition-opacity">18%</span>
            </div>
            <!-- X-Axis Label -->
            <div class="absolute -bottom-6 left-0 w-full flex justify-between text-[10px] text-gray-400 font-bold px-2">
              <span>9:00 AM</span>
              <span>11:00 AM</span>
              <span>1:00 PM</span>
              <span>3:00 PM</span>
              <span>5:00 PM</span>
              <span>7:00 PM</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Dynamic Staff Performance & Commission Summary -->
      <div class="bg-surface border border-secondary/20 rounded-2xl shadow-lg overflow-hidden mb-8">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
          <h4 class="font-serif text-lg font-bold text-primary">Stylist Performance &amp; Commission</h4>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse text-sm">
            <thead>
              <tr class="bg-gray-50 text-[10px] uppercase tracking-wider text-gray-500 border-b border-gray-100">
                <th class="p-4 font-bold">Stylist Name</th>
                <th class="p-4 font-bold text-center">Services Performed</th>
                <th class="p-4 font-bold text-right">Total Sales Generated</th>
                <th class="p-4 font-bold text-center">Role / Shift</th>
                <th class="p-4 font-bold text-right text-primary">Commission Earned</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 font-sans">
              @forelse($stylists as $stylist)
                @php
                    $rate = $stylist->commission_rate ?? 0;
                    $commission = $stylist->total_sales * ($rate / 100);
                @endphp
                <tr class="hover:bg-gray-50/50">
                  <td class="p-4 font-bold text-gray-800 flex items-center gap-2">
                    <img src="{{ asset($stylist->profile_image ?? 'https://via.placeholder.com/150') }}" class="w-6 h-6 rounded-full border border-secondary object-cover" alt="{{ $stylist->full_name }}">
                    <span>{{ $stylist->full_name }}</span>
                  </td>
                  <td class="p-4 text-center text-gray-600 font-semibold">{{ $stylist->services_count }} Services</td>
                  <td class="p-4 text-right text-gray-600 font-mono font-bold">${{ number_format($stylist->total_sales, 2) }}</td>
                  <td class="p-4 text-center text-secondary font-bold">{{ $stylist->role }} <span class="text-[10px] text-gray-400 block">({{ $stylist->shift_days }})</span></td>
                  <td class="p-4 text-right font-bold text-primary font-mono bg-green-50/30">
                    ${{ number_format($commission, 2) }} <span class="text-[10px] text-gray-400 block">({{ $rate }}%)</span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="p-4 text-center text-gray-500">No staff record found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <!-- Dynamic Inventory Usage Trends -->
      <div class="bg-surface border border-secondary/20 rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
          <h4 class="font-serif text-lg font-bold text-primary">Inventory Product Usage Trends</h4>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse text-sm">
            <thead>
              <tr class="bg-gray-50 text-[10px] uppercase tracking-wider text-gray-500 border-b border-gray-100">
                <th class="p-4 font-bold">Product Name</th>
                <th class="p-4 font-bold">Usage Level</th>
                <th class="p-4 font-bold">Current Stock Level</th>
                <th class="p-4 font-bold">Status &amp; Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
              @forelse($inventoryItems as $item)
                <tr class="hover:bg-gray-50/50">
                  <td class="p-4 font-bold text-primary">{{ $item->name }}</td>
                  <td class="p-4">
                    @if($item->stock_level <= 5)
                      <span class="inline-flex items-center gap-1.5 text-xs font-bold text-red-600"><span class="h-2 w-2 rounded-full bg-red-600"></span>High Usage</span>
                    @elseif($item->stock_level <= 15)
                      <span class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-600"><span class="h-2 w-2 rounded-full bg-amber-600"></span>Moderate Usage</span>
                    @else
                      <span class="inline-flex items-center gap-1.5 text-xs font-bold text-green-600"><span class="h-2 w-2 rounded-full bg-green-600"></span>Normal Usage</span>
                    @endif
                  </td>
                  <td class="p-4 font-mono font-bold">{{ $item->stock_level }} units</td>
                  <td class="p-4 text-xs font-semibold text-gray-500">
                    @if($item->stock_level <= 5)
                      <span class="text-red-600 font-bold block">Restock recommended immediately</span>
                    @elseif($item->stock_level <= 15)
                      <span class="text-amber-600 font-bold block">Reorder within 10 days</span>
                    @else
                      <span class="text-green-600 font-bold block">Stock levels healthy</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="p-4 text-center text-gray-500">No inventory products found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
 
  <!-- Modals -->
  <div id="exportModal" class="fixed inset-0 z-[100] modal-overlay hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md border border-secondary/20 overflow-hidden transform transition-all text-center">
      <div class="p-8">
        <div class="w-16 h-16 rounded-full bg-green-50 text-green-500 border border-green-200 flex items-center justify-center text-3xl mx-auto mb-6">
          <i class="fas fa-file-invoice"></i>
        </div>
        <h3 class="font-serif text-2xl font-bold text-gray-800 mb-2">Export Roster Reports</h3>
        <p class="text-sm text-gray-500 mb-6">Choose your preferred format to export analytical data for this month.</p>
        <div class="flex flex-col gap-3">
          <button class="w-full bg-primary text-white font-bold text-xs py-3 rounded-lg hover:bg-primary-container transition-colors flex items-center justify-center gap-2 shadow-md" onclick="document.getElementById('exportModal').classList.add('hidden'); alert('PDF Export Started...');">
            <span class="material-symbols-outlined text-sm">picture_as_pdf</span>
            <span>Download PDF Report</span>
          </button>
          <button class="w-full bg-secondary text-primary-container font-bold text-xs py-3 rounded-lg hover:bg-[#EDD98A] transition-colors flex items-center justify-center gap-2 shadow-md" onclick="document.getElementById('exportModal').classList.add('hidden'); alert('CSV Export Started...');">
            <span class="material-symbols-outlined text-sm">table_chart</span>
            <span>Download CSV (Excel)</span>
          </button>
          <button class="w-full mt-2 text-gray-400 font-bold text-xs uppercase tracking-widest hover:text-gray-600 transition-colors" onclick="document.getElementById('exportModal').classList.add('hidden')">
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection