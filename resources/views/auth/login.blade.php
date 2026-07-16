<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elegance Salon - Secure Access Gateway</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Hanken+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

  <!-- Tailwind CSS (must come before tailwind-config) -->
  <!-- Custom Styles -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script src="{{asset('script.js')}}"></script>
  <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body class="h-screen w-screen relative flex items-center justify-center bg-background-dark overflow-hidden">

  <!-- Background image covering the screen -->
  <div class="absolute inset-0 bg-cover bg-center select-none login-bg"></div>

  <!-- Emerald dark gradient overlay (0.85 opacity) -->
  <div class="absolute inset-0 bg-gradient-to-tr from-background-dark/95 via-emerald-deep/90 to-background-dark/95 z-0"></div>

  <!-- Perfectly Centered Glassmorphic Login Card -->
  <div class="w-full max-w-md mx-4 bg-black/40 backdrop-blur-md border border-secondary/20 rounded-3xl p-8 sm:p-10 shadow-2xl relative z-10">

    <!-- Gold Serif Logo at the top -->
    <div class="text-center mb-8">
      <a class="font-serif text-3xl font-bold text-secondary tracking-widest flex items-center justify-center gap-2 mb-3" href="index.html">
        <i class="fas fa-gem text-2xl"></i>ELEGANCE
      </a>
      <p class="text-xs text-secondary/60 font-semibold tracking-wider uppercase">Secure Console Access</p>
    </div>

    <!-- Login Form -->
    <form class="space-y-6"  action="{{route('admin.dashboard')}}">
      <!-- Username/Email Field -->
      <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest text-secondary/70 mb-2">Email or Username</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-secondary/50">
            <span class="material-symbols-outlined text-base">alternate_email</span>
          </span>
          <input type="text" required class="w-full pl-11 pr-4 py-3 bg-black/35 border border-secondary/15 rounded-xl text-sm text-white placeholder-white/30 focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary focus:bg-black/50 transition-all" placeholder="name@elegance.com">
        </div>
      </div>

      <!-- Password Field -->
      <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest text-secondary/70 mb-2">Password</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-secondary/50">
            <span class="material-symbols-outlined text-base">lock</span>
          </span>
          <input id="password-field" type="password" required class="w-full pl-11 pr-11 py-3 bg-black/35 border border-secondary/15 rounded-xl text-sm text-white placeholder-white/30 focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary focus:bg-black/50 transition-all" placeholder="••••••••">
          <!-- Toggle password visibility button -->
          <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-secondary/50 hover:text-secondary transition-colors">
            <span id="password-toggle-icon" class="material-symbols-outlined text-base">visibility</span>
          </button>
        </div>
      </div>

      <!-- CTA Sign In Button -->
      <div>
        <button type="submit" class="w-full bg-secondary text-primary-container font-bold text-xs uppercase tracking-widest py-4 rounded-xl hover:bg-secondary-dark hover:scale-[1.01] active:scale-[0.99] transition-all shadow-lg flex items-center justify-center gap-2">
          <span class="material-symbols-outlined text-sm font-bold">login</span>
          <span>Sign In to Elegance</span>
        </button>
      </div>
    </form>

    <!-- Footer Links inside Card -->
    <div class="mt-8 pt-6 border-t border-white/10 flex justify-between text-[11px] font-bold uppercase tracking-wider text-secondary/60">
      <a href="#" class="hover:text-secondary transition-colors" onclick="alert('Password reset link sent to your registered email address.')">Forgot Password?</a>
      <a href="{{route('home')}}" class="hover:text-secondary transition-colors flex items-center gap-1">
        <span class="material-symbols-outlined text-xs">arrow_back</span>
        <span>Return Home</span>
      </a>
    </div>
  </div>

  </body>
</html>