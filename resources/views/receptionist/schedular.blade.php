@extends('receptionist.layout.rec-layout')
@section('content')

    <!-- Content Area -->
    <div class="flex-grow p-4 sm:p-6 lg:p-8 overflow-y-auto scrollbar-lux flex flex-col">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
          <h2 class="font-serif text-3xl font-bold text-primary">Appointment Scheduling</h2>
          <p class="text-sm text-gray-500">Manage weekly bookings and staff availability.</p>
        </div>
        <div class="flex items-center gap-3">
          <button class="bg-surface border border-secondary text-primary font-bold text-xs px-5 py-3 rounded-full hover:bg-background transition-colors flex items-center gap-1.5 shadow-sm">
            <span class="material-symbols-outlined text-sm">edit_calendar</span>
            <span>Reschedule Slot</span>
          </button>
          <button class="bg-secondary text-primary-container font-bold text-xs px-5 py-3 rounded-full hover:bg-[#EDD98A] transition-colors flex items-center gap-1.5 shadow-lg" onclick="document.getElementById('bookingModal').classList.remove('hidden')">
            <span class="material-symbols-outlined text-sm">calendar_add_on</span>
            <span>Book Appointment</span>
          </button>
        </div>
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 flex-grow min-h-0">
        <!-- Left Panel: Calendar Nav & Integrations -->
        <div class="lg:col-span-1 space-y-6 overflow-y-auto pr-2 scrollbar-lux">
          <!-- Mini Month Navigator -->
          <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between mb-4">
              <button class="text-gray-400 hover:text-primary"><i class="fas fa-chevron-left"></i></button>
              <h4 class="font-serif text-lg font-bold text-primary">July 2026</h4>
              <button class="text-gray-400 hover:text-primary"><i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="grid grid-cols-7 gap-1 text-center text-xs font-bold text-gray-400 mb-2">
              <div>Su</div><div>Mo</div><div>Tu</div><div>We</div><div>Th</div><div>Fr</div><div>Sa</div>
            </div>
            <div class="grid grid-cols-7 gap-1 text-center text-sm">
              <div class="p-1 text-gray-300">28</div><div class="p-1 text-gray-300">29</div><div class="p-1 text-gray-300">30</div>
              <div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">1</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">2</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">3</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">4</div>
              <div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">5</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">6</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">7</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">8</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">9</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">10</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">11</div>
              <div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">12</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">13</div><div class="p-1 bg-secondary text-white font-bold rounded-full cursor-pointer shadow">14</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">15</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">16</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">17</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">18</div>
              <div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">19</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">20</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">21</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">22</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">23</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">24</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">25</div>
              <div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">26</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">27</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">28</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">29</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">30</div><div class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">31</div><div class="p-1 text-gray-300">1</div>
            </div>
          </div>
          <!-- Stylist Filter -->
          <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg">
            <h4 class="font-bold text-primary mb-4 text-sm uppercase tracking-wider">Filter by Stylist</h4>
            <div class="space-y-3">
              @forelse($staff as $stf)
                @if($stf->role === 'stylist')
                <label class="flex items-center gap-3 cursor-pointer">
                  <input type="checkbox" checked="" class="form-checkbox text-primary rounded border-gray-300 focus:ring-primary">
                  <span class="text-sm">{{ $stf->full_name }}</span>
                </label>
                @endif
              @empty
                <p class="text-xs text-gray-400">No stylists found.</p>
              @endforelse
            </div>
          </div>
          <!-- Integration Widget -->
          <div class="bg-gradient-to-br from-primary-container to-primary border border-secondary/30 rounded-2xl p-6 shadow-lg text-white">
            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-secondary mb-4 border border-secondary/30">
              <i class="fas fa-sync-alt"></i>
            </div>
            <h4 class="font-serif text-lg font-bold mb-2">Calendar Sync</h4>
            <p class="text-xs text-white/70 mb-4">Keep your schedules aligned by syncing this roster with external calendars.</p>
            <button class="w-full bg-white/10 border border-white/20 text-white font-bold text-xs py-2.5 rounded hover:bg-white/20 transition-colors flex items-center justify-center gap-2">
              <i class="fab fa-google"></i> Sync with Google / iCal
            </button>
          </div>
        </div>
        <!-- Right Panel: Weekly Grid Schedule -->
        <div class="lg:col-span-3 bg-surface border border-secondary/20 rounded-2xl shadow-lg flex flex-col overflow-hidden">
          <!-- Grid Header (Days) -->
          <div class="flex bg-gray-50 border-b border-gray-200">
            <div class="w-16 shrink-0 border-r border-gray-200"></div>
            <div class="flex-grow grid grid-cols-7 divide-x divide-gray-200">
              @foreach($weekDays as $day)
                <div class="p-3 text-center {{ $day['is_today'] ? 'bg-secondary/10 border-b-2 border-b-secondary' : '' }}">
                  <div class="text-[10px] font-bold uppercase {{ $day['is_today'] ? 'text-secondary' : 'text-gray-500' }}">{{ $day['name'] }}</div>
                  <div class="text-lg font-serif font-bold text-primary">{{ $day['date_num'] }}</div>
                </div>
              @endforeach
            </div>
          </div>
          <!-- Grid Body (Hours & Appointments) -->
          <div class="flex-grow overflow-x-auto scrollbar-lux">
            <div class="flex relative min-h-[800px] min-w-[650px]">
              <!-- Time Column -->
              <div class="w-16 shrink-0 border-r border-gray-200 flex flex-col divide-y divide-gray-100 text-[10px] text-gray-400 font-bold text-center">
                @for($h = 9; $h <= 18; $h++)
                  <div class="h-20 flex items-start justify-center pt-2">{{ date('g:i A', strtotime("$h:00")) }}</div>
                @endfor
              </div>
              <!-- Days Columns (Background grid) -->
              <div class="flex-grow grid grid-cols-7 divide-x divide-gray-100 absolute inset-0 left-16 z-0">
                @foreach($weekDays as $day)
                  <div class="flex flex-col divide-y divide-gray-50 {{ $day['is_today'] ? 'bg-secondary/5' : '' }}">
                    @for($h = 9; $h <= 18; $h++)
                      <div class="h-20"></div>
                    @endfor
                  </div>
                @endforeach
              </div>
              <!-- Dynamic Rendered Appointment Blocks (z-10) -->
              <div class="absolute inset-0 left-16 z-10 pointer-events-none">
                @foreach($gridAppointments as $apt)
                  <div 
                    class="absolute w-[calc(14.28%-8px)] bg-emerald-50 border-l-4 border-primary shadow-md rounded-r p-2 pointer-events-auto hover:bg-emerald-100 transition-colors"
                    style="left: calc({{ $apt['day_index'] * 14.28 }}% + 4px); top: {{ $apt['top_px'] }}px; height: {{ $apt['height_px'] }}px;"
                  >
                    <div class="text-[10px] font-bold text-primary">{{ $apt['time_formatted'] }}</div>
                    <div class="text-xs font-bold text-gray-800 truncate">{{ $apt['client_name'] }}</div>
                    <div class="text-[10px] text-gray-500 truncate">{{ $apt['service_name'] }} ({{ $apt['stylist_name'] }})</div>
                  </div>
                @endforeach
              </div>
              <!-- Current Time Line Indicator (e.g. Tuesday 11:30 AM) -->
              <div class="absolute left-16 right-0 top-[200px] z-20 flex items-center pointer-events-none">
                <div class="w-2 h-2 rounded-full bg-red-500 -ml-1"></div>
                <div class="h-px bg-red-500 flex-grow shadow-[0_0_4px_rgba(239,68,68,0.5)]"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- Modals (Hidden by Default) -->
  <!-- Book Appointment Modal -->
  <div id="bookingModal" class="fixed inset-0 z-[100] modal-overlay hidden flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl border border-secondary/20 overflow-hidden transform transition-all my-auto max-h-[90vh] flex flex-col">
      <div class="bg-primary-container p-5 sm:p-6 flex justify-between items-center text-white border-b border-secondary/30 shrink-0">
        <h3 class="font-serif text-xl sm:text-2xl font-bold text-secondary">Book Appointment</h3>
        <button class="text-white/60 hover:text-white transition-colors" onclick="document.getElementById('bookingModal').classList.add('hidden')">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      <div class="p-5 sm:p-8 overflow-y-auto scrollbar-lux flex-grow">
        <form class="space-y-6" action="{{ route('receptionist.appointments.store') }}" method="POST">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Client Selection -->
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Select Client</label>
              <div class="relative">
                <select name="client_id" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary appearance-none cursor-pointer" required>
                  <option value="" disabled selected>Select Client</option>
                  @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name ?? $client->full_name }}</option>
                  @endforeach
                </select>
                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400"><i class="fas fa-chevron-down text-xs"></i></div>
              </div>
            </div>
            <!-- Stylist Selection -->
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Assigned Stylist</label>
              <div class="relative">
                <select name="stylist_id" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary appearance-none cursor-pointer" required>
                  <option value="" disabled selected>Select Stylist</option>
                  @foreach($staff as $stf)
                    @if($stf->role === 'stylist')
                      <option value="{{ $stf->id }}">{{ $stf->full_name }}</option>
                    @endif
                  @endforeach
                </select>
                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400"><i class="fas fa-chevron-down text-xs"></i></div>
              </div>
            </div>
          </div>
          <!-- Service Selection -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @for ($i = 1; $i <= 3; $i++)
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Service Requested {{ $i }} {{ $i > 1 ? '(Optional)' : '' }}</label>
              <div class="relative">
                <select name="service_id_{{ $i }}" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary appearance-none cursor-pointer" {{ $i === 1 ? 'required' : '' }}>
                  <option value="" selected>Select Service {{ $i }}</option>
                  @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }} (${{ number_format($service->price ?? $service->total_price ?? 0, 2) }})</option>
                  @endforeach
                </select>
                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400"><i class="fas fa-chevron-down text-xs"></i></div>
              </div>
            </div>
            @endfor
            <!-- Date Picker -->
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Date</label>
              <input type="date" name="appointment_date" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" value="{{ date('Y-m-d') }}" required>
            </div>
            <!-- Time Picker -->
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Time Slot</label>
              <input type="time" name="appointment_time" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" value="10:00" required>
            </div>
          </div>
          <!-- Checkbox -->
          <div class="pt-2 pb-4 border-b border-gray-100">
            <label class="flex items-center gap-3 cursor-pointer">
              <input type="checkbox" checked="" class="form-checkbox w-5 h-5 text-secondary rounded border-gray-300 focus:ring-secondary">
              <span class="text-sm font-semibold text-gray-700">Send Automated SMS/Email Confirmation to Client</span>
            </label>
          </div>
          <!-- Actions -->
          <div class="flex items-center justify-end gap-4 mt-8">
            <button type="button" class="px-6 py-3 border border-gray-300 text-gray-600 font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-gray-50 transition-colors" onclick="document.getElementById('bookingModal').classList.add('hidden')">Cancel</button>
            <button type="submit" class="px-8 py-3 bg-secondary text-primary-container border border-secondary font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#EDD98A] transition-colors shadow-lg">Confirm Booking</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection