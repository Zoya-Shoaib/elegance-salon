@extends('admin.layouts.admin_layout')
@section('content')
    <!-- Content Area -->
    <div class="flex-grow p-4 sm:p-6 lg:p-8 overflow-y-auto scrollbar-lux">
      <div class="mb-6 sm:mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
          <h2 class="font-serif text-2xl sm:text-3xl font-bold text-primary">Inventory Vault</h2>
          <p class="text-xs sm:text-sm text-gray-500">Monitor stock levels, track usage, and manage supplier purchase orders.</p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full sm:w-auto">
          <div class="relative w-full sm:w-64">
            <input type="text" placeholder="Search inventory..." class="w-full pl-10 pr-4 py-2 border border-secondary/30 rounded-full text-sm bg-surface shadow-sm focus:ring-1 focus:ring-primary focus:border-primary">
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          </div>
          <button class="bg-secondary text-primary-container font-bold text-xs px-5 py-2.5 rounded-full hover:bg-[#EDD98A] transition-colors flex items-center justify-center gap-1.5 shadow-lg shrink-0" onclick="document.getElementById('addItemModal').classList.remove('hidden')">
            <span class="material-symbols-outlined text-sm">add_circle</span>
            <span>Add Item</span>
          </button>
        </div>
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Inventory Supply Table -->
        <div class="lg:col-span-2 space-y-6">
          <div class="bg-surface border border-secondary/20 rounded-2xl shadow-lg overflow-hidden flex flex-col h-full">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
              <h4 class="font-serif text-lg font-bold text-primary">Live Supply Tracker</h4>
              <div class="flex items-center gap-2">
                <span class="bg-red-100 text-red-700 border border-red-200 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">3 Low Stock</span>
              </div>
            </div>
            <div class="overflow-x-auto scrollbar-lux">
              <table class="w-full text-left border-collapse min-w-[700px]">
                <thead>
                  <tr class="text-[10px] uppercase tracking-wider text-gray-500 border-b border-gray-100">
                    <th class="p-4 font-bold">Item &amp; Category</th>
                    <th class="p-4 font-bold">Stock Level</th>
                    <th class="p-4 font-bold">Supplier</th>
                    <th class="p-4 font-bold text-center">Cost/Unit</th>
                    <th class="p-4 font-bold text-center">Status</th>
                    <th class="p-5 font-bold text-center">Actions</th>
                  </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-50">
                  <!-- Low Stock Item 1 -->
@foreach ($products as $product)
    @if ($product->is_active)
        <!-- ACTIVE PRODUCT ROW -->
        <tr class="hover:bg-gray-50/50 bg-red-50/30">
            <td class="p-4">
                <div class="font-bold text-primary">{{$product->name}}</div>
                <div class="text-xs text-gray-500">{{$product->category}}</div>
            </td>
            <td class="p-4">
                <div class="flex items-center justify-between text-xs mb-1">
                    <span class="font-bold text-red-600">{{ $product->stock_level }} left</span>
                    <span class="text-gray-400">Target: {{$product->target_stock}}</span>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar-fill bg-red-500 col-w-10"></div>
                </div>
            </td>
            <td class="p-4 text-gray-600">{{$product->supplier_name}}</td>
            <td class="p-4 text-center font-mono text-gray-600">${{$product->cost_per_unit}}</td>
            
            @if ($product->stock_level < 5)   
                <td class="p-4 text-center">
                    <span class="inline-block px-2 py-1 bg-red-100 text-red-800 border border-red-200 text-[10px] font-bold rounded-full uppercase tracking-wider">low</span>
                </td>
            @else
                <td class="p-4 text-center">
                    <span class="inline-block px-2 py-1 bg-green-100 text-green-800 border border-green-200 text-[10px] font-bold rounded-full uppercase tracking-wider">optimal</span>
                </td>
            @endif
            
            <td>
                <button class="edit-btn w-8 h-8 rounded-lg bg-gray-50 border border-gray-200 text-primary hover:bg-primary hover:text-white hover:border-primary transition-colors ms-5 shadow-sm" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-category="{{ $product->category }}" data-stock="{{ $product->stock_level }}" data-target="{{ $product->target_stock }}" data-supplier="{{$product->supplier_name}}" data-cost="{{$product->cost_per_unit}}" data-active="{{$product->is_active}}">
                    <span class="material-symbols-outlined text-sm">edit</span>
                </button>
            </td>
        </tr>
    @else
        <!-- INACTIVE / ARCHIVED PRODUCT ROW -->
        <!-- Fixed: Changed row background to bg-gray-50/40 to look beautifully quieted down -->
        <tr class="hover:bg-gray-50/80 bg-gray-50/40 opacity-75">
            <td class="p-4">
                <!-- Fixed: Combined line-through with text-gray-400 so it looks dimmed -->
                <div class="font-bold text-gray-400 line-through">{{$product->name}}</div>
                <div class="text-xs text-gray-400/80 line-through">{{$product->category}}</div>
            </td>
            <td class="p-4">
                <div class="flex items-center justify-between text-xs mb-1">
                    <!-- Fixed: Removed text-red-600 from archived stock levels -->
                    <span class="font-bold text-gray-400 line-through">{{ $product->stock_level }} left</span>
                    <span class="text-gray-400/60 line-through">Target: {{$product->target_stock}}</span>
                </div>
                <div class="progress-bar-container opacity-40">
                    <!-- Fixed: Muted the bar fill color to match an inactive state -->
                    <div class="progress-bar-fill bg-gray-400 col-w-10"></div>
                </div>
            </td>
            <td class="p-4 text-gray-400 line-through">{{$product->supplier_name}}</td>
            <td class="p-4 text-center font-mono text-gray-400 line-through">${{$product->cost_per_unit}}</td>
            
            <td class="p-4 text-center">
                <!-- Fixed: Clean layout matching your beautiful reference image pill -->
                <span class="inline-block px-2 py-1 bg-slate-100 text-slate-700 border border-slate-200 text-[10px] font-bold rounded-full uppercase tracking-wider">archive</span>
            </td>
            <td>
                <button class="edit-btn w-8 h-8 rounded-lg bg-gray-50 border border-gray-200 text-gray-400 hover:bg-primary hover:text-white hover:border-primary transition-colors ms-5 shadow-sm" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-category="{{ $product->category }}" data-stock="{{ $product->stock_level }}" data-target="{{ $product->target_stock }}" data-supplier="{{$product->supplier_name}}" data-cost="{{$product->cost_per_unit}}" data-active="{{$product->is_active}}">
                    <span class="material-symbols-outlined text-sm">edit</span>
                </button>
            </td>
        </tr>
    @endif
@endforeach

        
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- Right Side: Order Generator & Suppliers -->
        <div class="space-y-6">
          <!-- Auto Purchase Order Generator -->
          <div class="bg-surface border border-secondary/20 rounded-2xl shadow-lg p-6 relative overflow-hidden">
            <!-- Decorative background element -->
            <div class="absolute -right-4 -top-4 text-secondary/10 pointer-events-none">
              <i class="fas fa-file-invoice text-9xl"></i>
            </div>
            <h4 class="font-serif text-lg font-bold text-primary mb-2 relative z-10">Generate Purchase Order</h4>
            <p class="text-xs text-gray-500 mb-6 relative z-10">Automatically draft an order for all flagged low-stock items.</p>
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6 relative z-10">
              <div class="flex items-center justify-between mb-3 border-b border-amber-200/50 pb-2">
                <span class="text-[10px] font-bold text-amber-800 uppercase tracking-widest">Order Draft Summary</span>
                <span class="text-[10px] bg-amber-200 text-amber-900 px-2 py-0.5 rounded font-bold">2 Items</span>
              </div>
              <ul class="text-xs text-amber-900 space-y-2 mb-3">
                <li class="flex justify-between"><span>18x Keratin Treatment Kit</span> <span>$810.00</span></li>
                <li class="flex justify-between"><span>25x Gold Leaf Polish (Gel)</span> <span>$462.50</span></li>
              </ul>
              <div class="flex justify-between items-center border-t border-amber-200/50 pt-2 mt-2 font-bold text-amber-900 text-sm">
                <span>Total Draft Cost</span>
                <span>$1,272.50</span>
              </div>
            </div>
            <button class="w-full bg-secondary text-primary-container font-bold text-xs py-3.5 rounded-xl hover:bg-[#EDD98A] transition-colors flex items-center justify-center gap-2 shadow-lg relative z-10" onclick="document.getElementById('sendOrdersModal').classList.remove('hidden')">
              <span class="material-symbols-outlined text-sm">send</span>
              <span>Send Orders to Suppliers</span>
            </button>
          </div>
          <!-- Supplier Registry -->
          <div class="bg-surface border border-secondary/20 rounded-2xl shadow-lg p-6">
            <h4 class="font-serif text-lg font-bold text-primary mb-4 border-b border-gray-100 pb-2">Supplier Registry</h4>
            <div class="space-y-4 max-h-[300px] overflow-y-auto scrollbar-lux pr-2">
              <div class="border border-gray-100 rounded-lg p-3 hover:border-secondary/30 transition-colors">
                <div class="flex justify-between items-start mb-1">
                  <h5 class="font-bold text-primary text-sm">Olaplex Pro Direct</h5>
                  <span class="text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded">Active</span>
                </div>
                <div class="text-xs text-gray-500 flex flex-col gap-1 mt-2">
                  <span class="flex items-center gap-2"><i class="fas fa-envelope text-secondary"></i> orders@olaplex.pro</span>
                  <span class="flex items-center gap-2"><i class="fas fa-phone text-secondary"></i> +1 (800) 555-1212</span>
                </div>
              </div>
              <div class="border border-gray-100 rounded-lg p-3 hover:border-secondary/30 transition-colors">
                <div class="flex justify-between items-start mb-1">
                  <h5 class="font-bold text-primary text-sm">OPI Salon Supplies</h5>
                  <span class="text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded">Active</span>
                </div>
                <div class="text-xs text-gray-500 flex flex-col gap-1 mt-2">
                  <span class="flex items-center gap-2"><i class="fas fa-envelope text-secondary"></i> wholesale@opi.com</span>
                  <span class="flex items-center gap-2"><i class="fas fa-phone text-secondary"></i> +1 (800) 555-9090</span>
                </div>
              </div>
              <div class="border border-gray-100 rounded-lg p-3 hover:border-secondary/30 transition-colors">
                <div class="flex justify-between items-start mb-1">
                  <h5 class="font-bold text-primary text-sm">MedSpa Supplies Inc.</h5>
                  <span class="text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded">Active</span>
                </div>
                <div class="text-xs text-gray-500 flex flex-col gap-1 mt-2">
                  <span class="flex items-center gap-2"><i class="fas fa-envelope text-secondary"></i> support@medspa.net</span>
                  <span class="flex items-center gap-2"><i class="fas fa-phone text-secondary"></i> +1 (888) 555-4444</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 
  <!-- Modals -->
  <!-- Add Item Modal -->
  <div id="addItemModal" class="fixed inset-0 z-[100] modal-overlay hidden flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl border border-secondary/20 overflow-hidden transform transition-all my-auto max-h-[90vh] flex flex-col">
      <div class="bg-primary-container p-5 sm:p-6 flex justify-between items-center text-white border-b border-secondary/30 shrink-0">
        <h3 class="font-serif text-xl sm:text-2xl font-bold text-secondary">Add New Inventory Item</h3>
        <button class="text-white/60 hover:text-white transition-colors" onclick="document.getElementById('addItemModal').classList.add('hidden')">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      <div class="p-5 sm:p-8 overflow-y-auto scrollbar-lux">
        <form class="space-y-6" action="{{route('insert.inventory')}}" method="POST">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Item Name</label>
              <input type="text" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="e.g. Argan Oil Serum" required="" name="name">
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
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Current Stock</label>
              <input type="number" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" value="0" required="" name="stock_level">
            </div>
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Target Stock</label>
              <input type="number" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" value="10" required="" name="target_stock">
            </div>
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Cost/Unit</label>
              <input type="text" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="$0.00" required="" name="cost_per_unit">
            </div>
          </div>
          <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Supplier</label>
           <input type="text" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="Olaplex Pro Direct" required="" name="supplier_name">
          </div>
          <div class="flex items-center justify-end gap-4 mt-8 pt-4 border-t border-gray-100">
            <button type="button" class="px-6 py-3 border border-gray-300 text-gray-600 font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-gray-50 transition-colors" onclick="document.getElementById('addItemModal').classList.add('hidden')">Cancel</button>
            <button type="submit" class="px-8 py-3 bg-secondary text-primary-container border border-secondary font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#EDD98A] transition-colors shadow-lg">Save Item</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Edit Item Modal -->
  <div id="editItemModal" class="fixed inset-0 z-[100] modal-overlay hidden flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl border border-secondary/20 overflow-hidden transform transition-all my-auto max-h-[90vh] flex flex-col">
      <div class="bg-primary-container p-5 sm:p-6 flex justify-between items-center text-white border-b border-secondary/30 shrink-0">
        <h3 class="font-serif text-xl sm:text-2xl font-bold text-secondary">Edit Inventory Item</h3>
        <button class="text-white/60 hover:text-white transition-colors" onclick="document.getElementById('editItemModal').classList.add('hidden')">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      <div class="p-5 sm:p-8 overflow-y-auto scrollbar-lux">
        <form class="space-y-6" id="editModal" method="POST" >
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Item Name</label>
              <input type="text" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" id="name" required="" name="name">
            </div>
            <div>
            <label for="serviceCategory" class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:#0b3c2c;">
              Service Category <span class="text-red-400">*</span>
            </label>
            <select id="category" name="category" required
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
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Current Stock</label>
              <input type="number" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700"  required="" name="stock_level" id="stock_level">
            </div>
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Target Stock</label>
              <input type="number" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700"  required="" name="target_stock" id="target_stock">
            </div>
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Cost/Unit</label>
              <input type="text" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="$0.00" required="" name="cost_per_unit" id="cost_per_unit">
            </div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Supplier</label>
           <input type="text" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="Olaplex Pro Direct" required="" name="supplier_name" id="supplier_name">
          </div>
          <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Item Status</label>
              <select class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary appearance-none cursor-pointer" name="is_active" id="is_active">
                <option value="1">Active</option>
                <option value="0">Archived</option>
              </select>
            </div>
          <div class="flex items-center justify-end gap-4 mt-8 pt-4 border-t border-gray-100">
            <button type="button" class="px-6 py-3 border border-gray-300 text-gray-600 font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-gray-50 transition-colors" onclick="document.getElementById('editItemModal').classList.add('hidden')">Cancel</button>
            <button type="submit" class="px-8 py-3 bg-secondary text-primary-container border border-secondary font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#EDD98A] transition-colors shadow-lg">Save Item</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Send Orders Confirmation Modal -->
  <div id="sendOrdersModal" class="fixed inset-0 z-[100] modal-overlay hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md border border-secondary/20 overflow-hidden transform transition-all text-center">
      <div class="p-8">
        <div class="w-16 h-16 rounded-full bg-green-50 text-green-500 border border-green-200 flex items-center justify-center text-3xl mx-auto mb-6">
          <i class="fas fa-check-circle"></i>
        </div>
        <h3 class="font-serif text-2xl font-bold text-gray-800 mb-2">Confirm Purchase Orders</h3>
        <p class="text-sm text-gray-500 mb-4">You are about to send automated emails with purchase orders to the selected suppliers.</p>
        <div class="bg-gray-50 rounded-lg p-3 text-xs text-gray-600 font-mono mb-8 border border-gray-200">
          Total Draft Cost: $1,272.50<br>
          Suppliers Contacted: 2
        </div>
        <div class="flex items-center justify-center gap-4">
          <button type="button" class="px-6 py-3 border border-gray-300 text-gray-600 font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-gray-50 transition-colors w-1/2" onclick="document.getElementById('sendOrdersModal').classList.add('hidden')">Cancel</button>
          <button type="button" class="px-6 py-3 bg-primary text-white border border-primary font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-primary-container transition-colors shadow-lg w-1/2" onclick="document.getElementById('sendOrdersModal').classList.add('hidden'); alert('Orders Sent Successfully!');">Confirm &amp; Send</button>
        </div>
      </div>
    </div>
  </div>
  
@endsection