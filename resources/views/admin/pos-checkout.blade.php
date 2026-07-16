@extends('admin.layouts.admin_layout')
@section('content')

    <!-- Content Area -->
    <div class="flex-grow p-8 overflow-hidden flex flex-col">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 flex-grow overflow-hidden">
        <!-- Left Side: Catalog Area (approx. 60-65% width) -->
        <div class="lg:col-span-7 xl:col-span-8 flex flex-col overflow-hidden">
          <!-- Top Filter & Search Bar -->
          <div class="flex flex-col sm:flex-row gap-4 items-center justify-between mb-6 shrink-0">
            <!-- Filter Pills -->
            <div class="flex items-center gap-1.5 bg-white/80 border border-gray-200 rounded-full p-1 shadow-sm">
              <button class="px-5 py-2 rounded-full bg-secondary text-white text-xs font-bold transition-colors">All</button>
              <button class="px-5 py-2 rounded-full text-gray-500 hover:text-secondary text-xs font-bold transition-colors bg-transparent">Services</button>
              <button class="px-5 py-2 rounded-full text-gray-500 hover:text-secondary text-xs font-bold transition-colors bg-transparent">Products</button>
            </div>
            <!-- Search -->
            <div class="relative w-full sm:w-auto">
              <input type="text" placeholder="Search catalog..." class="w-full sm:w-64 pl-10 pr-4 py-2 border border-gray-200 rounded-full text-sm bg-white focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary shadow-sm">
              <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
          </div>
          <!-- Catalog Grid -->
          <div class="flex-grow overflow-y-auto scrollbar-lux pb-4 grid grid-cols-1 md:grid-cols-2 gap-5 pr-2">
            <!-- Card 1 -->
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:border-secondary transition-colors">
              <div>
                <div class="flex justify-between items-start gap-2 mb-1">
                  <h4 class="font-bold text-gray-800 text-sm">Couture Styling &amp; Cut</h4>
                  <span class="font-bold text-gray-900 font-sans text-sm shrink-0">$90.00</span>
                </div>
                <p class="text-xs text-gray-500 mb-4">Wash, trim, balayage details</p>
              </div>
              <button class="w-full bg-secondary text-white font-bold text-xs py-2.5 rounded-lg hover:bg-secondary-dark transition-colors shadow-sm uppercase tracking-wider">ADD TO CART</button>
            </div>
            <!-- Card 2 -->
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:border-secondary transition-colors">
              <div>
                <div class="flex justify-between items-start gap-2 mb-1">
                  <h4 class="font-bold text-gray-800 text-sm">Bespoke Balayage &amp; Gl...</h4>
                  <span class="font-bold text-gray-900 font-sans text-sm shrink-0">$240.00</span>
                </div>
                <p class="text-xs text-gray-500 mb-4">Full custom hair coloring session</p>
              </div>
              <button class="w-full bg-secondary text-white font-bold text-xs py-2.5 rounded-lg hover:bg-secondary-dark transition-colors shadow-sm uppercase tracking-wider">ADD TO CART</button>
            </div>
            <!-- Card 3 -->
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:border-secondary transition-colors">
              <div>
                <div class="flex justify-between items-start gap-2 mb-1">
                  <h4 class="font-bold text-gray-800 text-sm">Keratin Smoothing The...</h4>
                  <span class="font-bold text-gray-900 font-sans text-sm shrink-0">$180.00</span>
                </div>
                <p class="text-xs text-gray-500 mb-4">Smoothing and anti-frizz treatment</p>
              </div>
              <button class="w-full bg-secondary text-white font-bold text-xs py-2.5 rounded-lg hover:bg-secondary-dark transition-colors shadow-sm uppercase tracking-wider">ADD TO CART</button>
            </div>
            <!-- Card 4 -->
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:border-secondary transition-colors">
              <div>
                <div class="flex justify-between items-start gap-2 mb-1">
                  <h4 class="font-bold text-gray-800 text-sm">Signature Gel Manicure</h4>
                  <span class="font-bold text-gray-900 font-sans text-sm shrink-0">$45.00</span>
                </div>
                <p class="text-xs text-gray-500 mb-4">Clean, exfoliate and curation polish</p>
              </div>
              <button class="w-full bg-secondary text-white font-bold text-xs py-2.5 rounded-lg hover:bg-secondary-dark transition-colors shadow-sm uppercase tracking-wider">ADD TO CART</button>
            </div>
            <!-- Card 5 -->
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:border-secondary transition-colors">
              <div>
                <div class="flex justify-between items-start gap-2 mb-1">
                  <h4 class="font-bold text-gray-800 text-sm">Hydrafacial Pro Treatm...</h4>
                  <span class="font-bold text-gray-900 font-sans text-sm shrink-0">$150.00</span>
                </div>
                <p class="text-xs text-gray-500 mb-4">Resurfacing extraction &amp; skin lift</p>
              </div>
              <button class="w-full bg-secondary text-white font-bold text-xs py-2.5 rounded-lg hover:bg-secondary-dark transition-colors shadow-sm uppercase tracking-wider">ADD TO CART</button>
            </div>
            <!-- Card 6 -->
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:border-secondary transition-colors">
              <div>
                <div class="flex justify-between items-start gap-2 mb-1">
                  <h4 class="font-bold text-gray-800 text-sm">Bridal Prep Makeup Gla...</h4>
                  <span class="font-bold text-gray-900 font-sans text-sm shrink-0">$350.00</span>
                </div>
                <p class="text-xs text-gray-500 mb-4">Trial consultation and full glamour makeup</p>
              </div>
              <button class="w-full bg-secondary text-white font-bold text-xs py-2.5 rounded-lg hover:bg-secondary-dark transition-colors shadow-sm uppercase tracking-wider">ADD TO CART</button>
            </div>
            <!-- Card 7 -->
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:border-secondary transition-colors">
              <div>
                <div class="flex justify-between items-start gap-2 mb-1">
                  <h4 class="font-bold text-gray-800 text-sm">L'Oréal Professionnel El...</h4>
                  <span class="font-bold text-gray-900 font-sans text-sm shrink-0">$48.00</span>
                </div>
                <p class="text-xs text-gray-500 mb-4">Hair Care • In stock: 45</p>
              </div>
              <button class="w-full bg-secondary text-white font-bold text-xs py-2.5 rounded-lg hover:bg-secondary-dark transition-colors shadow-sm uppercase tracking-wider">ADD TO CART</button>
            </div>
            <!-- Card 8 -->
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:border-secondary transition-colors">
              <div>
                <div class="flex justify-between items-start gap-2 mb-1">
                  <h4 class="font-bold text-gray-800 text-sm">Kerastase Nutritive Sha...</h4>
                  <span class="font-bold text-gray-900 font-sans text-sm shrink-0">$35.00</span>
                </div>
                <p class="text-xs text-gray-500 mb-4">Hair Care • In stock: 8</p>
              </div>
              <button class="w-full bg-secondary text-white font-bold text-xs py-2.5 rounded-lg hover:bg-secondary-dark transition-colors shadow-sm uppercase tracking-wider">ADD TO CART</button>
            </div>
          </div>
        </div>
        <!-- Right Side: Register Checkout Order Panel (approx. 35-40% width) -->
        <div class="lg:col-span-5 xl:col-span-4 flex flex-col h-full bg-white rounded-3xl shadow-sm border border-gray-200 p-6 overflow-hidden">
          <!-- Header -->
          <div class="mb-6 shrink-0">
            <h3 class="font-serif text-2xl font-bold text-secondary">Register Checkout Order</h3>
          </div>
          <!-- Scrollable checkout settings wrapper -->
          <div class="flex-grow overflow-y-auto scrollbar-lux pr-1 space-y-6 mb-6">
            <!-- Customer Selection -->
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">CUSTOMER SELECTION</label>
              <div class="relative">
                <input type="text" placeholder="Search customer directory..." class="w-full pl-10 pr-10 py-3 bg-[#FAF8F3] border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary">
                <i class="far fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <button class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- Empty Cart Placeholder State -->
            <div class="border-2 border-dashed border-gray-200 rounded-2xl p-8 text-center bg-[#FAF8F3]/50">
              <span class="material-symbols-outlined text-4xl text-gray-300 mb-2">shopping_cart_off</span>
              <p class="text-xs text-gray-500 leading-relaxed">Your retail checkout cart is empty. Click items in the catalog to add.</p>
            </div>
            <!-- Financial Calculations -->
            <div class="space-y-3 text-sm text-gray-600">
              <div class="flex justify-between">
                <span>Cart Subtotal</span>
                <span class="font-semibold font-mono">$0.00</span>
              </div>
              <div class="flex justify-between">
                <span>Tax (8%)</span>
                <span class="font-semibold font-mono">$0.00</span>
              </div>
              <hr class="border-gray-200 my-1">
              <div class="flex justify-between text-base font-bold text-gray-800">
                <span>Total Due</span>
                <span class="font-mono text-primary">$0.00</span>
              </div>
            </div>
            <!-- Payment Method Selector -->
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">PAYMENT METHOD</label>
              <div class="grid grid-cols-3 gap-2">
                <!-- Selected button: border secondary gold, text gold -->
                <button class="border border-secondary text-secondary py-3 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-secondary/5 transition-colors bg-white">Card</button>
                <button class="border border-gray-200 text-gray-500 py-3 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-gray-50 transition-colors bg-white">Cash</button>
                <button class="border border-gray-200 text-gray-500 py-3 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-gray-50 transition-colors bg-white">Apple Pay</button>
              </div>
            </div>
          </div>
          <!-- Checkout CTA Button -->
          <div class="shrink-0 pt-4 border-t border-gray-100">
            <button class="w-full bg-secondary text-white py-4 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-secondary-dark transition-colors shadow-lg flex items-center justify-center gap-2" onclick="document.getElementById('paymentModal').classList.remove('hidden')">
              <span class="material-symbols-outlined text-sm font-bold">shopping_bag</span>
              <span>CONFIRM AND GENERATE RECEIPT</span>
            </button>
          </div>
        </div>
      </div>
    </div>
 
  <!-- Modals -->
  <!-- Process Payment Modal -->
  <div id="paymentModal" class="fixed inset-0 z-[100] modal-overlay hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md border border-secondary/20 overflow-hidden transform transition-all text-center">
      <div class="p-8">
        <div class="w-20 h-20 rounded-full bg-green-50 text-green-500 border border-green-200 flex items-center justify-center text-4xl mx-auto mb-6">
          <i class="fas fa-check-circle"></i>
        </div>
        <h3 class="font-serif text-2xl font-bold text-gray-800 mb-2">Payment Successful!</h3>
        <p class="text-sm text-gray-500 mb-6">Transaction has been processed and recorded.</p>
        <div class="bg-gray-50 rounded-lg p-4 text-left text-sm text-gray-700 mb-8 border border-gray-200">
          <div class="flex justify-between mb-2">
            <span class="text-gray-500">Invoice:</span>
            <span class="font-bold font-mono">INV-78401</span>
          </div>
          <div class="flex justify-between mb-2">
            <span class="text-gray-500">Client:</span>
            <span class="font-bold">Walk-in Customer</span>
          </div>
          <div class="flex justify-between mb-2">
            <span class="text-gray-500">Amount Paid:</span>
            <span class="font-bold text-primary font-mono">$0.00</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-500">Method:</span>
            <span class="font-bold">Card</span>
          </div>
        </div>
        <div class="flex flex-col gap-3">
          <button type="button" class="w-full px-6 py-3 bg-secondary text-white font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-secondary-dark transition-colors shadow-lg flex items-center justify-center gap-2" onclick="document.getElementById('paymentModal').classList.add('hidden')">
            <i class="fas fa-print text-sm"></i> Print Invoice
          </button>
          <button type="button" class="w-full px-6 py-3 border border-gray-300 text-gray-600 font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center gap-2" onclick="document.getElementById('paymentModal').classList.add('hidden')">
            <i class="fas fa-envelope text-sm"></i> Email Receipt
          </button>
          <button type="button" class="w-full mt-2 px-6 py-2 text-gray-400 font-bold text-xs uppercase tracking-widest hover:text-gray-600 transition-colors" onclick="document.getElementById('paymentModal').classList.add('hidden')">
            Close &amp; Start New Transaction
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection