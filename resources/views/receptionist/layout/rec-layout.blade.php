<!DOCTYPE html><html lang="en"><head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elegance Salon - Receptionist Dashboard</title>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&amp;family=Hanken+Grotesk:wght@400;600;700&amp;display=swap" rel="stylesheet">
  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
  <!-- Tailwind CSS -->
    <!-- Tailwind CSS (must come before tailwind-config) -->
  <!-- Custom Styles -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script src="{{asset('script.js')}}"></script>
  <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body class="overflow-hidden flex h-screen w-screen bg-background relative">
  <!-- Mobile Sidebar Backdrop -->
  <div id="sidebarBackdrop" class="fixed inset-0 bg-black/60 z-40 hidden lg:hidden transition-opacity" aria-hidden="true"></div>

  <!-- Restricted Receptionist Sidebar Navigation -->
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
        <a href="{{route('receptionist.dashboard')}}" class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">dashboard</span>
          <span>Dashboard Overview</span>
        </a>
        <a href="{{route('receptionist.scheduler')}}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">calendar_month</span>
          <span>Calendar Scheduler</span>
        </a>
        <a href="{{route('receptionist.clients')}}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">group</span>
          <span>Clients Directory</span>
        </a>
        <a href="{{route('receptionist.posCheckout')}}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 font-medium transition-colors">
          <span class="material-symbols-outlined text-lg">point_of_sale</span>
          <span>POS Checkout</span>
        </a>
      </nav>
    </div>
    <!-- Active User (Receptionist) -->
    <div class="p-4 border-t border-white/10 bg-black/20">
      <div class="flex items-center gap-3 mb-3">
        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&amp;w=150&amp;auto=format&amp;fit=crop" class="w-10 h-10 rounded-full border border-secondary object-cover" alt="Active User">
        <div class="min-w-0 flex-grow">
          <div class="font-bold text-sm truncate text-white">{{ Auth::check() ? Auth::user()->name : 'Sarah Jenkins' }}</div>
          <div class="text-xs text-white/60 truncate">{{ Auth::check() ? ucfirst(Auth::user()->role) : 'Receptionist' }}</div>
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
          <span class="text-secondary font-bold">Reception Portal</span>
        </div>
      </div>
      <div class="flex items-center gap-3 sm:gap-6">
        <div class="hidden sm:flex items-center gap-2 bg-white/10 border border-secondary/30 text-secondary rounded-full px-3.5 py-1.5 text-xs font-bold shadow-sm">
          <span class="h-2 w-2 rounded-full bg-secondary"></span>
          <span>Receptionist Access</span>
        </div>
        <a href="{{ route('home') }}" class="text-xs text-white/70 hover:text-secondary font-bold flex items-center gap-1.5 transition-colors">
          <span class="material-symbols-outlined text-sm">logout</span>
          <span class="hidden sm:inline">Exit Console</span>
        </a>
      </div>
    </header>
  @yield("content")
   </main>
  </body></html>