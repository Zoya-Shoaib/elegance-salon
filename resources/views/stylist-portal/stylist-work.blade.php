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
<body class="overflow-hidden flex h-screen w-screen bg-background">
  <!-- Restricted Stylist Sidebar Navigation -->
  <aside class="w-72 bg-primary-container text-white flex flex-col justify-between border-r border-secondary/20 shrink-0">
    <div>
      <div class="p-6 border-b border-white/10 flex items-center justify-between">
        <a class="font-serif text-xl font-bold text-secondary tracking-tighter flex items-center gap-2" href="home.html">
          <i class="fas fa-gem"></i>ELEGANCE
        </a>
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
        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&amp;w=150&amp;auto=format&amp;fit=crop" class="w-10 h-10 rounded-full border border-secondary object-cover" alt="Active Stylist">
        <div class="min-w-0 flex-grow">
          <div class="font-bold text-sm truncate text-white">Marcus Vance</div>
          <div class="text-xs text-white/60 truncate">Senior Stylist</div>
        </div>
      </div>
    </div>
  </aside>
  <!-- Main Viewport -->
  <main class="flex-grow flex flex-col overflow-hidden h-screen relative">
    <!-- Header Bar -->
    <header class="h-20 bg-primary-container border-b border-secondary/20 px-6 flex items-center justify-between shrink-0">
      <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-white/50">
        <span>Console</span>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="text-secondary font-bold">Stylist Portal</span>
      </div>
      <div class="flex items-center gap-6">
        <div class="flex items-center gap-2 bg-white/10 border border-secondary/30 text-secondary rounded-full px-4 py-1.5 text-xs font-bold shadow-sm">
          <span class="h-2 w-2 rounded-full bg-secondary"></span>
          <span>Stylist Access</span>
        </div>
        <a href="{{ route('login') }}" class="text-xs text-white/70 hover:text-secondary font-bold flex items-center gap-1.5 transition-colors">
          <span class="material-symbols-outlined text-sm">logout</span>
          <span>Exit Console</span>
        </a>
      </div>
    </header>
    <!-- Content Area -->
    <div class="flex-grow p-8 overflow-y-auto scrollbar-lux space-y-8">
      <!-- Welcome Header -->
      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
          <h2 class="font-serif text-3xl font-bold text-primary">Stylist Workspace</h2>
          <p class="text-sm text-gray-500">Welcome back, Marcus. Review your daily schedule and commissions.</p>
        </div>
        <div class="bg-white border border-secondary/30 rounded-xl px-4 py-2 shadow-sm text-xs font-bold text-gray-600">
          Today: July 15, 2026
        </div>
      </div>
      <!-- Notification Alert Banner -->
      <div class="bg-amber-50 border-l-4 border-secondary p-4 rounded-r-xl flex items-start gap-3 shadow-sm shrink-0">
        <span class="material-symbols-outlined text-secondary mt-0.5">info</span>
        <div class="text-sm">
          <span class="font-bold text-primary-container">Reminders:</span>
          <span class="text-gray-700">You have 5 scheduled appointments today. First service begins at 10:00 AM.</span>
        </div>
      </div>
      <!-- My Performance Metrics (Top Row Cards) -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Assigned Shift -->
        <div class="bg-white border border-secondary/20 rounded-2xl p-6 shadow-md flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">My Assigned Shift</span>
            <h3 class="text-base font-bold text-primary font-sans leading-tight mt-1">Mon, Tue, Thu, Fri</h3>
            <span class="text-xs text-gray-500 font-semibold block">9:00 AM - 6:00 PM</span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">schedule</span>
          </div>
        </div>
        <!-- Today's Appointments -->
        <div class="bg-white border border-secondary/20 rounded-2xl p-6 shadow-md flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">Appointments Today</span>
            <h3 class="text-2xl font-bold text-primary font-sans">5 Scheduled</h3>
            <span class="text-xs text-gray-400 font-semibold truncate block">For Marcus Vance</span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">event_available</span>
          </div>
        </div>
        <!-- Commission Rate -->
        <div class="bg-white border border-secondary/20 rounded-2xl p-6 shadow-md flex items-center justify-between">
          <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold">My Commission Rate</span>
            <h3 class="text-2xl font-bold text-primary font-sans">15%</h3>
            <span class="text-xs text-secondary font-semibold flex items-center gap-1">
              <i class="fas fa-percent text-[10px]"></i> Standard Tier
            </span>
          </div>
          <div class="w-12 h-12 rounded-xl bg-background border border-secondary/30 flex items-center justify-center text-secondary text-xl">
            <span class="material-symbols-outlined">percent</span>
          </div>
        </div>
      </div>
      <!-- My Scheduled Appointments for Today -->
      <div class="bg-white border border-secondary/20 rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
          <h4 class="font-serif text-lg font-bold text-primary">My Scheduled Appointments</h4>
          <span class="bg-primary/10 text-primary text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider font-sans">Assigned Schedule</span>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-[#FAF8F3]/50 text-[10px] uppercase tracking-wider text-gray-500 border-b border-gray-100">
                <th class="p-5 font-bold">Client Name</th>
                <th class="p-5 font-bold">Service Booked</th>
                <th class="p-5 font-bold">Time Slot</th>
                <th class="p-5 font-bold">Status</th>
              </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100 font-sans">
              <!-- Row 1 -->
              <tr class="hover:bg-gray-50/50">
                <td class="p-5 font-bold text-primary">Jessica Miller</td>
                <td class="p-5 text-gray-600">Couture Styling &amp; Cut</td>
                <td class="p-5 text-gray-600 font-mono">10:00 AM</td>
                <td class="p-5">
                  <span class="inline-block px-2.5 py-1 bg-green-50 text-primary text-[10px] font-bold rounded-full border border-green-200">Scheduled</span>
                </td>
              </tr>
              <!-- Row 2 -->
              <tr class="hover:bg-gray-50/50">
                <td class="p-5 font-bold text-primary">Emma Watson</td>
                <td class="p-5 text-gray-600">Signature Gel Manicure</td>
                <td class="p-5 text-gray-600 font-mono">01:30 PM</td>
                <td class="p-5">
                  <span class="inline-block px-2.5 py-1 bg-green-50 text-primary text-[10px] font-bold rounded-full border border-green-200">Scheduled</span>
                </td>
              </tr>
              <!-- Row 3 -->
              <tr class="hover:bg-gray-50/50">
                <td class="p-5 font-bold text-primary">Sarah Khan</td>
                <td class="p-5 text-gray-600">Hydrafacial Pro Treatment</td>
                <td class="p-5 text-gray-600 font-mono">04:00 PM</td>
                <td class="p-5">
                  <span class="inline-block px-2.5 py-1 bg-green-50 text-primary text-[10px] font-bold rounded-full border border-green-200">Scheduled</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- My Personal Commission Tracker -->
      <div class="bg-white border border-secondary/20 rounded-2xl shadow-lg p-6 max-w-xl">
        <h4 class="font-serif text-lg font-bold text-primary mb-4 border-b border-gray-100 pb-2">Commission Ledger</h4>
        <div class="grid grid-cols-2 gap-6 divide-x divide-gray-100">
          <div>
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold block mb-1">Today's Estimated Payout</span>
            <span class="text-2xl font-bold text-primary font-mono">$40.50</span>
            <span class="text-[10px] text-gray-400 block mt-1">Based on completed services</span>
          </div>
          <div class="pl-6">
            <span class="text-xs uppercase tracking-wider text-gray-500 font-bold block mb-1">This Week's Commission</span>
            <span class="text-2xl font-bold text-secondary-dark font-mono">$280.00</span>
            <span class="text-[10px] text-gray-400 block mt-1">Cumulative weekly total</span>
          </div>
        </div>
      </div>
    </div>
  </main>

  </body></html>