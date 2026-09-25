@extends('admin.layouts.admin_layout')
@section('content')

<!-- Success Alert Banner -->
@if(session('success'))
<div class="mb-6 p-4 rounded-xl border flex items-center justify-between shadow-sm animate-fade-in"
  style="background-color: #e6f4ea; border-color: #34a853;">
  <div class="flex items-center gap-3">
    <!-- Success Icon -->
    <span class="material-symbols-outlined font-bold" style="color: #137333;">
      check_circle
    </span>
    <div>
      <h4 class="text-sm font-bold" style="color: #137333;">Action Successful</h4>
      <p class="text-xs mt-0.5" style="color: #137333;">{{ session('success') }}</p>
    </div>
  </div>
  <!-- Close Button -->
  <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition-colors">
    <span class="material-symbols-outlined text-sm">close</span>
  </button>
</div>
@endif

<!-- Content Area -->
<div class="flex-grow p-4 sm:p-6 lg:p-8 overflow-y-auto scrollbar-lux space-y-8 sm:space-y-12">

  <!-- Page Title Row -->
  <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 sm:gap-6">
    <div>
      <h1 class="font-serif text-2xl sm:text-3xl font-bold" style="color:#0b3c2c;">Register Checkout Order</h1>
      <p class="text-xs sm:text-sm text-gray-500 mt-1">Select client details, assign a stylist, and choose the services provided for this visit.</p>
    </div>
    <div>
      <a href="{{ route('admin.services') }}" id="viewServicesBtn"
        class="btn-gold inline-flex items-center justify-center gap-2 font-bold text-xs px-6 py-3 h-12 rounded-full shadow-lg w-full sm:w-auto"
        style="color:#0A4A35;">
        <span class="material-symbols-outlined text-sm">spa</span>
        <span>Add New Service</span>
      </a>
    </div>
  </div>

  <!-- Form Card -->
  <div class="form-card bg-white border border-secondary/20 rounded-2xl shadow-lg overflow-hidden">
    <div class="h-1 w-full" style="background:linear-gradient(90deg,#0b3c2c 0%,#D4AF37 50%,#0b3c2c 100%);"></div>

    <div class="p-5 sm:p-8 md:p-10">
      <form id="checkoutOrderForm" class="space-y-8" action="{{route('insert.order')}}" method="POST">
        @csrf


        <input type="hidden" name="total_amount" id="total_amount_input" value="0.00">
        <!-- Section 1: Client & Staff Assignment -->
        <div class="section-divider"><span>Order Identity</span></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="clientSelect" class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:#0b3c2c;">
              Select Client <span class="text-red-400">*</span>
            </label>
            <select
              name="client_id"
              id="client_id"
              class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary appearance-none cursor-pointer">

              <option value="">Select Client</option>
              @foreach ($clients as $client )

              <option value="{{$client->id}}">{{$client->name}}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label for="staffSelect" class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:#0b3c2c;">
              Assign Stylist / Staff <span class="text-red-400">*</span>
            </label>
            <select
              name="staff_id"
              id="staff_id"
              class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary appearance-none cursor-pointer">

              <option value="">Select Stylist</option>
              @foreach ($staff as $stf)
              @if ($stf->role==="stylist")

              <option value="{{$stf->id}}">{{$stf->full_name}}</option>
              @endif
              @endforeach



            </select>
          </div>
        </div>

        <!-- Section 2: Services Selection -->
        <div class="section-divider"><span>Services Selection</span></div>

        <div>
          <label class="block text-[10px] font-bold uppercase tracking-widest mb-3" style="color:#0b3c2c;">
            Select Services Performed <span class="text-red-400">*</span>
          </label>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 field-cream border rounded-lg p-6 max-h-[280px] overflow-y-auto">

            @for ($i = 1; $i <= 3; $i++)
              <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">
                Service {{ $i }} {{ $i > 1 ? '(Optional)' : '' }}
              </label>
              <div class="relative">
                <select
                  name="service_id_{{ $i }}"
                  id="service_id_{{ $i }}"
                  class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary appearance-none cursor-pointer"
                  {{ $i === 1 ? 'required' : '' }}>
                  <option value="">Select Service {{ $i }}</option>

                  @foreach ($services as $service)
                  <option value="{{ $service->id }}" data-price="{{$service->total_price}}">
                    {{ $service->name }}
                  </option>

                  @endforeach
                </select>

                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                  <i class="fas fa-chevron-down text-xs"></i>
                </div>
              </div>
          </div>
          @endfor

        </div>

        <p class="text-[10px] text-gray-400 mt-2 italic">Check all services completed during this visit.</p>
    </div>

    <!-- Section 3: Order Summary -->
    <div class="section-divider"><span>Order Summary</span></div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50/50 p-6 border rounded-xl">
      <div>
        <span class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">
          Subtotal
        </span>
        <span class="text-lg font-bold text-gray-700 font-serif" id="subtotal-display">0.00</span>
      </div>

      <div>
        <span class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">
          Estimated Tax (8%)
        </span>
        <span class="text-lg font-bold text-gray-700 font-serif" id="tax-display">$0.00</span>
      </div>

      <div class="md:border-l md:pl-6 border-gray-200">
        <span class="block text-[10px] font-bold uppercase tracking-widest mb-1" style="color:#0b3c2c;">
          Total Amount Due
        </span>
        <span class="text-2xl font-bold font-serif" style="color:#0b3c2c;" id="total-display">$0.00</span>
      </div>
    </div>

    <!-- Form Actions -->
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 pt-6 border-t border-gray-100 mt-2">
      <p class="text-xs text-gray-400 italic flex items-center gap-1.5">
        <span class="material-symbols-outlined text-secondary" style="font-size:14px;">info</span>
        Fields marked <span class="text-red-400 font-bold mx-1">*</span> are required to complete the checkout.
      </p>
      <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full sm:w-auto shrink-0">
        <button type="reset" id="cancelBtn"
          class="btn-cancel px-6 py-3 border border-gray-300 text-gray-600 font-bold text-xs uppercase tracking-widest rounded-lg w-full sm:w-auto text-center justify-center">
          Clear Order
        </button>
        <button type="submit" id="saveOrderBtn"
          class="btn-save px-6 sm:px-8 py-3 border border-secondary font-bold text-xs uppercase tracking-widest rounded-lg shadow-lg flex items-center justify-center gap-2 w-full sm:w-auto">
          <span class="material-symbols-outlined text-sm">receipt</span>
          Save Order &amp; Receipt
        </button>
      </div>
    </div>

    </form>
  </div>
</div>

<!-- Orders Table Section (Static Version) -->
<div class="mt-8 sm:mt-12">
  <h2 class="font-serif text-2xl sm:text-3xl font-bold mb-4 sm:mb-6" style="color:#0b3c2c;">Orders List</h2>

  <div class="bg-white rounded-3xl shadow-lg border border-secondary/10 overflow-hidden">
    <div class="overflow-x-auto scrollbar-lux">
      <table class="w-full text-left border-collapse min-w-[750px]">
        <thead>
          <tr style="background-color: #0b3c2c; color: #D4AF37;">
            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider">ID</th>
            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider">Client</th>
            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider">Stylist</th>
            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider">Services</th>
            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider">Total</th>
            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider">Date</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm">

          <!-- Static Row 1 -->
          <tr class="hover:bg-gray-50/50 transition-colors">
            <td class="py-4 px-6 font-semibold text-gray-700">#1001</td>
            <td class="py-4 px-6 text-gray-800 font-medium">Fatima Zahra</td>
            <td class="py-4 px-6 text-gray-600">Ayesha Khan</td>
            <td class="py-4 px-6 text-gray-600 max-w-xs truncate">Couture Styling & Cut, Keratin Treatment</td>
            <td class="py-4 px-6 font-bold font-serif" style="color:#0b3c2c;">$291.60</td>
            <td class="py-4 px-6 text-gray-500 text-xs">Jul 25, 2026</td>

          </tr>



        </tbody>
      </table>
    </div>
  </div>
</div>

</div>



<script>
  document.addEventListener('DOMContentLoaded', () => {
    const TAX_RATE = 0.08; // 8% Tax

    // Array of all 3 service dropdown elements by ID
    const serviceSelects = [
      document.getElementById('service_id_1'),
      document.getElementById('service_id_2'),
      document.getElementById('service_id_3')
    ];

    const subtotalEl = document.getElementById('subtotal-display');
    const taxEl = document.getElementById('tax-display');
    const totalEl = document.getElementById('total-display');

    // Target hidden input field for form submission
    const totalInput = document.getElementById('total_amount_input');
    const checkoutForm = document.getElementById('checkoutOrderForm');

    function calculateTotals() {
      let subtotal = 0;

      // Loop through each select element
      serviceSelects.forEach(select => {
        if (select && select.selectedIndex !== -1) {
          const selectedOption = select.options[select.selectedIndex];
          const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
          subtotal += price;
        }
      });

      // Calculate Tax and Total Amount
      const tax = subtotal * TAX_RATE;
      const total = subtotal + tax;

      // Update DOM Displays
      if (subtotalEl) subtotalEl.textContent = `$${subtotal.toFixed(2)}`;
      if (taxEl) taxEl.textContent = `$${tax.toFixed(2)}`;
      if (totalEl) totalEl.textContent = `$${total.toFixed(2)}`;

      // 👈 YAHAN ADD KARNI HAI: Hidden input update for Backend
      if (totalInput) {
        totalInput.value = total.toFixed(2);
      }
    }

    // Attach change listener to each service dropdown
    serviceSelects.forEach(select => {
      if (select) {
        select.addEventListener('change', calculateTotals);
      }
    });

    // Reset support for "Clear Order" / Form Reset
    if (checkoutForm) {
      checkoutForm.addEventListener('reset', () => {
        setTimeout(calculateTotals, 50);
      });
    }
  });
</script>
@endsection