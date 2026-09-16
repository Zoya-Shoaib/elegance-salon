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
    <div class="flex-grow p-8 overflow-y-auto scrollbar-lux">

      <!-- Page Title Row -->
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
        <div>
          <h1 class="font-serif text-3xl font-bold" style="color:#0b3c2c;">Add New Service</h1>
          <p class="text-sm text-gray-500 mt-1">Define a new treatment, set its pricing, and link it to the products it
            uses.</p>
        </div>
        <div>
          <a href="{{route('admin.posCheckout')}}" id="billServiceBtn"
            class="btn-gold inline-flex items-center gap-2 font-bold text-xs px-6 py-3 h-12 rounded-full shadow-lg"
            style="color:#0A4A35;">
            <span class="material-symbols-outlined text-sm">receipt_long</span>
            <span>Bill a Service</span>
          </a>
        </div>
      </div>



  <!-- Form Card -->
  <div class="form-card bg-white border border-secondary/20 rounded-2xl shadow-lg overflow-hidden">
    <div class="h-1 w-full" style="background:linear-gradient(90deg,#0b3c2c 0%,#D4AF37 50%,#0b3c2c 100%);"></div>

    <div class="p-8 md:p-10">
      <form id="addServiceForm" class="space-y-8" action="{{route('insert.service')}}" method="POST">

        <!-- Section 1: Service Identity -->
        <div class="section-divider"><span>Service Identity</span></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="serviceName" class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:#0b3c2c;">
              Service Name <span class="text-red-400">*</span>
            </label>
            <input type="text" id="serviceName" name="name" placeholder="e.g. Luxury Balayage Treatment" required
              class="field-cream w-full border rounded-lg px-4 py-3 text-sm text-gray-700 transition-all duration-200">
          </div>
          <div>
            <label for="serviceCategory" class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:#0b3c2c;">
              Service Category <span class="text-red-400">*</span>
            </label>
            <select id="serviceCategory" name="category" required
              class="field-cream w-full border rounded-lg px-4 py-3 text-sm text-gray-700 transition-all duration-200 pr-10">
              <option value="" disabled selected>Select a category…</option>
              <option value="hair">Hair Services</option>
              <option value="skin">Skin &amp; Aesthetics</option>
              <option value="nails">Nail Services</option>
              <option value="makeup">Makeup &amp; Styling</option>
              <option value="massage">Massage &amp; Wellness</option>
              <option value="bridal">Bridal Packages</option>
              <option value="other">Other / Bespoke</option>
            </select>
          </div>
        </div>

        <div>
          <label for="serviceDescription" class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:#0b3c2c;">
            Service Description
          </label>
          <textarea id="serviceDescription" name="description" rows="4"
            placeholder="Describe what this service includes, the technique used, the benefits for the client, and any aftercare advice…"
            class="field-cream w-full border rounded-lg px-4 py-3 text-sm text-gray-700 resize-none transition-all duration-200"></textarea>
        </div>

        <!-- Section 2: Products & Pricing -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          @for ($i = 1; $i <= 3; $i++)
  <div>
    <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">
      Product Requested {{ $i }} {{ $i > 1 ? '(Optional)' : '' }}
    </label>
    <div class="relative">
      <select
        name="product_id_{{ $i }}"
        id="product_id_{{ $i }}"
        class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary appearance-none cursor-pointer"
        {{ $i === 1 ? 'required' : '' }}
      >
        <option value="">Select Product {{ $i }}</option>

        @foreach ($products as $product)
          <option value="{{ $product->id }}">
            {{ $product->name }}
          </option>
        @endforeach
      </select>
      
      <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
        <i class="fas fa-chevron-down text-xs"></i>
      </div>
    </div>
  </div>
@endfor

        <!-- Pricing Row (Only the required base price input remains) -->
        <div class="w-full ">
          <label for="basePrice" class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:#0b3c2c;">
            Base Price – Labor Charge <span class="text-red-400">*</span>
          </label>
          <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold" style="color:#0b3c2c;">$</span>
            <input type="number" id="basePrice" name="base_price" placeholder="0.00" min="0" step="0.01" required
              class="field-cream w-full border rounded-lg pl-8 pr-4 py-3 text-sm text-gray-700 transition-all duration-200">
          </div>
          <p class="text-[10px] text-gray-400 mt-1.5 italic">Base service charge before calculating product expenses.</p>
        </div>

     

        <!-- Form Actions -->
        <div class="w-full col-span-2 flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-gray-100 mt-2">
          <p class="text-xs text-gray-400 italic flex items-center gap-1.5">
            <span class="material-symbols-outlined text-secondary" style="font-size:14px;">info</span>
            Fields marked <span class="text-red-400 font-bold mx-1">*</span> are required to save the service.
          </p>
          <div class="flex items-center gap-3 shrink-0">
            <button type="reset" id="cancelBtn"
              class="btn-cancel px-6 py-3 border border-gray-300 text-gray-600 font-bold text-xs uppercase tracking-widest rounded-lg">
              Clear Form
            </button>
            <button type="submit" id="saveServiceBtn"
              class="btn-save px-8 py-3 border border-secondary font-bold text-xs uppercase tracking-widest rounded-lg shadow-lg flex items-center gap-2">
              <span class="material-symbols-outlined text-sm">save</span>
              Save Service
            </button>
          </div>
        </div>

      </form>
    </div>
  </div>

</div>
@endsection