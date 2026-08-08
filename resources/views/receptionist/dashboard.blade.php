@extends('receptionist.layout.rec-layout')
@section('content')

    <!-- Content Area -->
    <div class="flex-grow p-8 overflow-y-auto scrollbar-lux space-y-8">
      <!-- Header Title -->
      <div>
        <h2 class="font-serif text-3xl font-bold text-primary">Front Desk Console</h2>
        <p class="text-sm text-gray-500">Coordinate scheduled appointments, directory roster, and checkout transactions.</p>
      </div>
      <!-- Front-Desk Quick Actions (Top Row Cards) -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Open Booking Calendar -->
        <a href="{{route('receptionist.scheduler')}}" class="bg-white border border-secondary/40 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-secondary transition-all text-left flex items-center gap-4 group">
          <div class="w-12 h-12 rounded-xl bg-primary/5 flex items-center justify-center text-primary text-2xl group-hover:scale-105 transition-transform shrink-0">
            <span class="material-symbols-outlined">calendar_month</span>
          </div>
          <div>
            <h4 class="font-serif text-lg font-bold text-primary">Open Booking Calendar</h4>
            <p class="text-xs text-gray-500">View and update daily schedules</p>
          </div>
        </a>
        <!-- Manage Client Directory -->
        <a href="{{route('receptionist.clients')}}" class="bg-white border border-secondary/40 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-secondary transition-all text-left flex items-center gap-4 group">
          <div class="w-12 h-12 rounded-xl bg-primary/5 flex items-center justify-center text-primary text-2xl group-hover:scale-105 transition-transform shrink-0">
            <span class="material-symbols-outlined">group</span>
          </div>
          <div>
            <h4 class="font-serif text-lg font-bold text-primary">Manage Client Directory</h4>
            <p class="text-xs text-gray-500">Access registered client profiles</p>
          </div>
        </a>
        <!-- Launch POS Terminal -->
        <a href="{{route('receptionist.posCheckout')}}" class="bg-white border border-secondary/40 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-secondary transition-all text-left flex items-center gap-4 group">
          <div class="w-12 h-12 rounded-xl bg-primary/5 flex items-center justify-center text-primary text-2xl group-hover:scale-105 transition-transform shrink-0">
            <span class="material-symbols-outlined">point_of_sale</span>
          </div>
          <div>
            <h4 class="font-serif text-lg font-bold text-primary">Launch POS Terminal</h4>
            <p class="text-xs text-gray-500">Process standard transactions</p>
          </div>
        </a>
      </div>
      <!-- Today's Scheduled Appointments Table -->
      <div class="bg-white border border-secondary/20 rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
          <h4 class="font-serif text-lg font-bold text-primary">Today's Scheduled Appointments</h4>
          <span class="bg-primary/10 text-primary text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Confirmed Lists</span>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-[#FAF8F3]/50 text-[10px] uppercase tracking-wider text-gray-500 border-b border-gray-100">
                <th class="p-5 font-bold">Client Name</th>
                <th class="p-5 font-bold">Appointed Stylist</th>
                <th class="p-5 font-bold">Service Booked</th>
                <th class="p-5 font-bold">Time Slot</th>
                <th class="p-5 font-bold">Status</th>
              </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100 font-sans">
              @forelse($todayAppointments as $apt)
                <tr class="hover:bg-gray-50/50">
                  <td class="p-5 font-bold text-primary">{{ $apt->client->name ?? $apt->client->full_name ?? 'N/A' }}</td>
                  <td class="p-5 text-gray-600">{{ $apt->stylist->name ?? $apt->stylist->full_name ?? 'N/A' }}</td>
                  <td class="p-5 text-gray-600">{{ $apt->service1->name ?? 'General Service' }}</td>
                  <td class="p-5 text-gray-600 font-mono">{{ $apt->appointment_time ?? $apt->time_slot ?? 'N/A' }}</td>
                  <td class="p-5">
                    <span class="inline-block px-2.5 py-1 bg-green-50 text-primary text-[10px] font-bold rounded-full border border-green-200">{{ ucfirst($apt->status ?? 'Scheduled') }}</span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="p-5 text-center text-gray-500">No appointments scheduled for today.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <!-- Daily Appointment Metrics -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Metric 1 -->
        <div class="bg-white border border-secondary/20 rounded-2xl p-6 shadow-md flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Total Bookings Today</span>
            <h3 class="text-2xl font-bold text-primary">{{ $totalBookings }} Scheduled</h3>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">event_available</span>
          </div>
        </div>
        <!-- Metric 2 -->
        <div class="bg-white border border-secondary/20 rounded-2xl p-6 shadow-md flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Completed Bookings</span>
            <h3 class="text-2xl font-bold text-primary">{{ $completedBookings }} Completed</h3>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">task_alt</span>
          </div>
        </div>
        <!-- Metric 3 -->
        <div class="bg-white border border-secondary/20 rounded-2xl p-6 shadow-md flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Remaining Bookings</span>
            <h3 class="text-2xl font-bold text-primary">{{ $pendingBookings }} Pending</h3>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">pending_actions</span>
          </div>
        </div>
      </div>
    </div>
 
@endsection