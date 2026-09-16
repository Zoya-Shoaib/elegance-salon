<!DOCTYPE html><html lang="en"><head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elegance Salon - Dashboard Overview</title>
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
  <!-- Sidebar Navigation -->
  <aside class="w-72 bg-primary-container text-white flex flex-col justify-between border-r border-secondary/20 shrink-0">
    <div>
      <div class="p-6 border-b border-white/10 flex items-center justify-between">
        <a class="font-serif text-xl font-bold text-secondary tracking-tighter flex items-center gap-2" href="home.html">
          <i class="fas fa-gem"></i>ELEGANCE
        </a>
      </div>
      <nav class="p-4 space-y-1.5 overflow-y-auto max-h-[calc(100vh-200px)] scrollbar-lux">
        <a href="{{route('admin.dashboard')}}" class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">dashboard</span>
          <span>Dashboard Overview</span>
        </a>
        <a href="{{route('admin.scheduler')}}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">calendar_month</span>
          <span>Calendar Scheduler</span>
        </a>
        <a href="{{route('appointments.index')}}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">event</span>
          <span>Appointments</span>
        </a>
        <a href="{{route('admin.clients')}}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">group</span>
          <span>Clients Directory</span>
        </a>
        <a href="{{route('fetch.inventory')}}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">inventory_2</span>
          <span>Inventory Vault</span>
        </a>
        <a href="{{route('admin.staff')}}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">badge</span>
          <span>Staff Schedules</span>
        </a>
        <a href="{{route('admin.posCheckout')}}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">point_of_sale</span>
          <span>POS Checkout</span>
        </a>
        <a href="{{route('admin.analytics')}}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">bar_chart</span>
          <span>Reports &amp; Analytics</span>
        </a>
       <a href="{{route('admin.services')}}"
            class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
            <span class="material-symbols-outlined text-lg">spa</span>
            <span >Services</span>
          </a>
      </nav>
    </div>
    <!-- Active User -->
    <div class="p-4 border-t border-white/10 bg-black/20">
      <div class="flex items-center gap-3 mb-3">
        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&amp;w=150&amp;auto=format&amp;fit=crop" class="w-10 h-10 rounded-full border border-secondary object-cover" alt="Active User">
        <div class="min-w-0 flex-grow">
          <div class="font-bold text-sm truncate text-white">Clarissa Gold</div>
          <div class="text-xs text-white/60 truncate">Salon Admin</div>
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
        <span class="text-secondary font-bold">Reports</span>
      </div>
      <div class="flex items-center gap-6">
        <div class="flex items-center gap-2 bg-white/10 border border-secondary/30 text-secondary rounded-full px-4 py-1.5 text-xs font-bold shadow-sm">
          <span class="h-2 w-2 rounded-full bg-secondary"></span>
          <span>Admin Access</span>
        </div>
        <a href="{{route('home')}}" class="text-xs text-white/70 hover:text-secondary font-bold flex items-center gap-1.5 transition-colors">
          <span class="material-symbols-outlined text-sm">logout</span>
          <span>Exit Console</span>
        </a>
      </div>
    </header>
@yield('content')
 </main>
  </body></html>