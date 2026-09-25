<!DOCTYPE html><html lang="en"><head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elegance Salon - Stylist Workspace</title>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&amp;family=Hanken+Grotesk:wght@400;600;700&amp;display=swap" rel="stylesheet">
  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
  <!-- Tailwind CSS -->
    <!-- Tailwind CSS (must come before tailwind-config) -->
  <!-- Custom Styles -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script src="{{ asset('script.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="overflow-hidden flex h-screen w-screen bg-background relative">
  <!-- Mobile Sidebar Backdrop -->
  <div id="sidebarBackdrop" class="fixed inset-0 bg-black/60 z-40 hidden lg:hidden transition-opacity" aria-hidden="true"></div>

  <!-- Restricted Stylist Sidebar Navigation -->
  <aside id="portalSidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-primary-container text-white flex flex-col justify-between border-r border-secondary/20 shrink-0 transform -translate-x-full lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out shadow-2xl lg:shadow-none">
    <div>
      <div class="p-6 border-b border-white/10 flex items-center justify-between">
        <a class="font-serif text-xl font-bold text-secondary tracking-tighter flex items-center gap-2" href="{{ route('home') }}">
          <i class="fas fa-gem"></i>ELEGANCE
        </a>
        <button id="sidebarClose" class="lg:hidden text-white/60 hover:text-white p-1 rounded-md transition-colors" aria-label="Close sidebar">
          <span class="material-symbols-outlined text-xl">close</span>
        </button>
      </div>
      <nav class="p-4 space-y-1.5 overflow-y-auto max-h-[calc(100vh-200px)] scrollbar-lux">
        <a href="{{route('stylist.dashboard')}}" class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">dashboard</span>
          <span>My Workspace</span>
        </a>
        <a href="{{ route('home') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">logout</span>
          <span>Log Out</span>
        </a>
      </nav>
    </div>
    <!-- Active User (Stylist) -->
    <div class="p-4 border-t border-white/10 bg-black/20">
      <div class="flex items-center gap-3 mb-3">
        <img src="{{ asset($stylist->profile_image ?? 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&amp;w=150&amp;auto=format&amp;fit=crop') }}" class="w-10 h-10 rounded-full border border-secondary object-cover" alt="Active Stylist">
        <div class="min-w-0 flex-grow">
          <div class="font-bold text-sm truncate text-white">{{ $stylist->full_name ?? 'Marcus Vance' }}</div>
          <div class="text-xs text-white/60 truncate">{{ $stylist->role ?? 'Senior Stylist' }}</div>
        </div>
      </div>
    </div>
  </aside>
  <!-- Main Viewport -->
  <main class="flex-grow flex flex-col overflow-hidden h-screen relative w-full min-w-0">
    <!-- Header Bar -->
    <header class="h-20 bg-primary-container border-b border-secondary/20 px-4 sm:px-6 flex items-center justify-between shrink-0">
      <div class="flex items-center gap-3">
        <button id="sidebarToggle" class="lg:hidden text-white/80 hover:text-white p-2 rounded-lg hover:bg-white/10 transition-colors focus:outline-none" aria-label="Open sidebar">
          <span class="material-symbols-outlined text-2xl">menu</span>
        </button>
        <div class="flex items-center gap-1.5 sm:gap-2 text-[10px] sm:text-xs font-semibold uppercase tracking-wider text-white/50">
          <span>Console</span>
          <span class="material-symbols-outlined text-xs">chevron_right</span>
          <span class="text-secondary font-bold">Stylist Portal</span>
        </div>
      </div>
      <div class="flex items-center gap-3 sm:gap-6">
        <div class="hidden sm:flex items-center gap-2 bg-white/10 border border-secondary/30 text-secondary rounded-full px-3.5 py-1.5 text-xs font-bold shadow-sm">
          <span class="h-2 w-2 rounded-full bg-secondary"></span>
          <span>Stylist Access</span>
        </div>
        <a href="{{ route('login') }}" class="text-xs text-white/70 hover:text-secondary font-bold flex items-center gap-1.5 transition-colors">
          <span class="material-symbols-outlined text-sm">logout</span>
          <span class="hidden sm:inline">Exit Console</span>
        </a>
      </div>
    </header>
    <!-- Content Area -->
    <div class="flex-grow p-4 sm:p-6 lg:p-8 overflow-y-auto scrollbar-lux space-y-6 sm:space-y-8">
      <!-- Welcome Header -->
      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
          <h2 class="font-serif text-2xl sm:text-3xl font-bold text-primary">Stylist Workspace</h2>
          <p class="text-sm text-gray-500">Welcome back, {{ explode(' ', $stylist->full_name)[0] ?? 'Marcus' }}. Review your daily schedule and commissions.</p>
        </div>
        <div class="bg-white border border-secondary/30 rounded-xl px-4 py-2 shadow-sm text-xs font-bold text-gray-600">
          Today: {{ \Carbon\Carbon::now()->format('F j, Y') }}
        </div>
      </div>
      <!-- Notification Alert Banner -->
      <div class="bg-amber-50 border-l-4 border-secondary p-4 rounded-r-xl flex items-start gap-3 shadow-sm shrink-0">
        <span class="material-symbols-outlined text-secondary mt-0.5">info</span>
        <div class="text-sm">
          <span class="font-bold text-primary-container">Reminders:</span>
          <span class="text-gray-700">You have scheduled appointments today. Review your client list below.</span>
        </div>
      </div>
      <!-- My Performance Metrics (Top Row Cards) -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <!-- Assigned Shift -->
        <div class="bg-white border border-secondary/20 rounded-2xl p-6 shadow-md flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">My Assigned Shift</span>
            <h3 class="text-base font-bold text-primary font-sans leading-tight mt-1">{{ $stylist->shift_days ?? 'Flexible' }}</h3>
            <span class="text-xs text-gray-500 font-semibold block">{{ $stylist->shift_timing ?? '9:00 AM - 6:00 PM' }}</span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">schedule</span>
          </div>
        </div>
        <!-- All Appointments -->
        <div class="bg-white border border-secondary/20 rounded-2xl p-6 shadow-md flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Total Scheduled</span>
            <h3 class="text-2xl font-bold text-primary font-sans">{{ $appointments->count() }} Scheduled</h3>
            <span class="text-xs text-gray-400 font-semibold truncate block">For {{ $stylist->full_name ?? 'Marcus Vance' }}</span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">event_available</span>
          </div>
        </div>
        <!-- Commission Rate -->
        <div class="bg-white border border-secondary/20 rounded-2xl p-6 shadow-md flex items-center justify-between sm:col-span-2 md:col-span-1">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">My Commission Rate</span>
            <h3 class="text-2xl font-bold text-primary font-sans">{{ $stylist->commission_rate ?? 0 }}%</h3>
            <span class="text-xs text-secondary font-semibold flex items-center gap-1">
              <i class="fas fa-percent text-[10px]"></i> Standard Tier
            </span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">percent</span>
          </div>
        </div>
      </div>
      <!-- My Scheduled Appointments -->
      <div class="bg-white border border-secondary/20 rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
          <h4 class="font-serif text-lg font-bold text-primary">All Scheduled Appointments</h4>
          <span class="bg-primary/10 text-primary text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider font-sans">Assigned Schedule</span>
        </div>
        <div class="overflow-x-auto scrollbar-lux">
          <table class="w-full text-left border-collapse min-w-[600px]">
            <thead>
              <tr class="bg-[#FAF8F3]/50 text-[10px] uppercase tracking-wider text-gray-500 border-b border-gray-100">
                <th class="p-5 font-bold">Client Name</th>
                <th class="p-5 font-bold">Service Booked</th>
                <th class="p-5 font-bold">Time Slot</th>
                <th class="p-5 font-bold">Status</th>
              </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100 font-sans">
              @forelse($appointments as $apt)
                <tr class="hover:bg-gray-50/50">
                  <td class="p-5 font-bold text-primary">{{ $apt->client->name ?? $apt->client->full_name ?? 'N/A' }}</td>
                  <td class="p-5 text-gray-600">{{ $apt->service1->name ?? 'General Service' }}</td>
                  <td class="p-5 text-gray-600 font-mono">{{ $apt->appointment_time ?? $apt->time_slot ?? 'N/A' }}</td>
                  <td class="p-5">
                    <span class="inline-block px-2.5 py-1 bg-green-50 text-primary text-[10px] font-bold rounded-full border border-green-200">{{ ucfirst($apt->status ?? 'Scheduled') }}</span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="p-5 text-center text-gray-500">No upcoming appointments scheduled.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <!-- My Personal Commission Tracker -->
      <div class="bg-white border border-secondary/20 rounded-2xl shadow-lg p-6 max-w-xl">
        <h4 class="font-serif text-lg font-bold text-primary mb-4 border-b border-gray-100 pb-2">Commission Ledger</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 divide-y sm:divide-y-0 sm:divide-x divide-gray-100">
          <div>
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold block mb-1">Today's Estimated Payout</span>
            <span class="text-2xl font-bold text-primary font-mono">${{ number_format($todayCommission, 2) }}</span>
            <span class="text-[10px] text-gray-400 block mt-1">Based on completed services</span>
          </div>
          <div class="pt-4 sm:pt-0 sm:pl-6">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold block mb-1">This Week's Commission</span>
            <span class="text-2xl font-bold text-secondary-dark font-mono">${{ number_format($weekCommission, 2) }}</span>
            <span class="text-[10px] text-gray-400 block mt-1">Cumulative weekly total</span>
          </div>
        </div>
      </div>
    </div>
  </main>

  </body></html>