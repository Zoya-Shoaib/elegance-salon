@extends('admin.layouts.admin_layout')
@section('content')
  
    <!-- Content Area -->
    <div class="flex-grow p-8 overflow-y-auto scrollbar-lux">
      <!-- Top Actions & Search -->
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
        <div>
          <h2 class="font-serif text-3xl font-bold text-primary">Clients Directory</h2>
          <p class="text-sm text-gray-500">Manage client profiles, preferences, and visit history.</p>
        </div>
        <div class="flex flex-col sm:flex-row items-center gap-4">
          <!-- Search & Filter -->
          <div class="flex border border-secondary/30 rounded-full bg-surface shadow-sm overflow-hidden h-12 w-full sm:w-auto">
            <div class="px-4 flex items-center text-gray-400 bg-gray-50 border-r border-secondary/30">
              <i class="fas fa-search"></i>
            </div>
            <input type="text" placeholder="Search by name or email..." class="border-none focus:ring-0 px-4 py-2 w-64 text-sm text-gray-700 bg-transparent">
            <select class="border-none focus:ring-0 bg-gray-50 text-sm font-semibold border-l border-secondary/30 text-primary cursor-pointer px-4">
              <option>All Clients</option>
              <option>VIP Members</option>
              <option>Recent Visitors</option>
            </select>
          </div>
          <!-- Add Button -->
          <button class="bg-secondary text-primary-container font-bold text-xs px-6 py-3 h-12 rounded-full hover:bg-[#EDD98A] transition-colors flex items-center gap-2 shadow-lg w-full sm:w-auto justify-center" onclick="document.getElementById('clientModal').classList.remove('hidden')">
            <span class="material-symbols-outlined text-sm">person_add</span>
            <span>Register Client</span>
          </button>
        </div>
      </div>
      <!-- Client Database Table -->
      <div class="bg-surface border border-secondary/20 rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse min-w-[1000px]">
            <thead>
              <tr class="bg-gray-50 text-[10px] uppercase tracking-wider text-gray-500 border-b border-secondary/20">
                <th class="p-5 font-bold">Client Profile</th>
                <th class="p-5 font-bold">Contact Info</th>
                <th class="p-5 font-bold">Visit History &amp; Services</th>
                <th class="p-5 font-bold">Client Preferences</th>
                <th class="p-5 font-bold text-center">Actions</th>
              </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
              <!-- Record 1 -->
              <tr class="hover:bg-gray-50/50 group">
                <td class="p-5">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-secondary/20 border border-secondary/50 flex items-center justify-center text-secondary font-serif font-bold text-lg shrink-0">IS</div>
                    <div>
                      <div class="font-bold text-primary text-base flex items-center gap-2">Isabella Swan <span class="bg-amber-100 text-amber-800 border border-amber-200 text-[9px] px-1.5 py-0.5 rounded uppercase tracking-wider font-bold">VIP</span></div>
                      <div class="text-xs text-gray-500">Member since 2024</div>
                    </div>
                  </div>
                </td>
                <td class="p-5">
                  <div class="text-gray-700 font-medium">isabella.swan@example.com</div>
                  <div class="text-xs text-gray-500 font-mono mt-0.5">+1 (310) 555-0192</div>
                </td>
                <td class="p-5">
                  <div class="text-gray-700 font-medium">12 Total Visits</div>
                  <div class="text-xs text-gray-500 mt-0.5">Last: Jul 2, 2026 (Balayage)</div>
                </td>
                <td class="p-5">
                  <span class="inline-block px-3 py-1 bg-green-50 text-primary border border-green-200 text-[11px] font-bold rounded-full">
                    <i class="fas fa-heart text-secondary mr-1"></i> Prefers: Clarissa (Hair)
                  </span>
                  <div class="text-xs text-gray-500 mt-1 italic">Notes: Allergic to lavender oil.</div>
                </td>
                <td class="p-5 text-center">
                  <div class="flex items-center justify-center gap-2">
                    <button class="w-8 h-8 rounded-lg bg-gray-50 border border-gray-200 text-primary hover:bg-primary hover:text-white hover:border-primary transition-colors flex items-center justify-center shadow-sm" onclick="document.getElementById('clientModal').classList.remove('hidden')">
                      <span class="material-symbols-outlined text-sm">edit</span>
                    </button>
                    <button class="w-8 h-8 rounded-lg bg-gray-50 border border-gray-200 text-red-500 hover:bg-red-500 hover:text-white hover:border-red-500 transition-colors flex items-center justify-center shadow-sm" onclick="document.getElementById('deleteModal').classList.remove('hidden')">
                      <span class="material-symbols-outlined text-sm">delete</span>
                    </button>
                  </div>
                </td>
              </tr>
              <!-- Record 2 -->
              <tr class="hover:bg-gray-50/50 group">
                <td class="p-5">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center text-primary font-serif font-bold text-lg shrink-0">MG</div>
                    <div>
                      <div class="font-bold text-primary text-base flex items-center gap-2">Maria Garcia</div>
                      <div class="text-xs text-gray-500">Member since 2025</div>
                    </div>
                  </div>
                </td>
                <td class="p-5">
                  <div class="text-gray-700 font-medium">m.garcia99@example.com</div>
                  <div class="text-xs text-gray-500 font-mono mt-0.5">+1 (323) 555-8834</div>
                </td>
                <td class="p-5">
                  <div class="text-gray-700 font-medium">4 Total Visits</div>
                  <div class="text-xs text-gray-500 mt-0.5">Last: Jun 15, 2026 (Hydration Facial)</div>
                </td>
                <td class="p-5">
                  <span class="inline-block px-3 py-1 bg-green-50 text-primary border border-green-200 text-[11px] font-bold rounded-full">
                    <i class="fas fa-heart text-secondary mr-1"></i> Prefers: Dr. Helen (Skin)
                  </span>
                </td>
                <td class="p-5 text-center">
                  <div class="flex items-center justify-center gap-2">
                    <button class="w-8 h-8 rounded-lg bg-gray-50 border border-gray-200 text-primary hover:bg-primary hover:text-white hover:border-primary transition-colors flex items-center justify-center shadow-sm">
                      <span class="material-symbols-outlined text-sm">edit</span>
                    </button>
                    <button class="w-8 h-8 rounded-lg bg-gray-50 border border-gray-200 text-red-500 hover:bg-red-500 hover:text-white hover:border-red-500 transition-colors flex items-center justify-center shadow-sm">
                      <span class="material-symbols-outlined text-sm">delete</span>
                    </button>
                  </div>
                </td>
              </tr>
              <!-- Record 3 -->
              <tr class="hover:bg-gray-50/50 group">
                <td class="p-5">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center text-primary font-serif font-bold text-lg shrink-0">CJ</div>
                    <div>
                      <div class="font-bold text-primary text-base flex items-center gap-2">Chloe Jensen</div>
                      <div class="text-xs text-gray-500">Member since 2026</div>
                    </div>
                  </div>
                </td>
                <td class="p-5">
                  <div class="text-gray-700 font-medium">chloe.j@example.com</div>
                  <div class="text-xs text-gray-500 font-mono mt-0.5">+1 (424) 555-1022</div>
                </td>
                <td class="p-5">
                  <div class="text-gray-700 font-medium">1 Total Visit</div>
                  <div class="text-xs text-gray-500 mt-0.5">Last: May 10, 2026 (Manicure)</div>
                </td>
                <td class="p-5">
                  <span class="inline-block px-3 py-1 bg-green-50 text-primary border border-green-200 text-[11px] font-bold rounded-full">
                    <i class="fas fa-heart text-secondary mr-1"></i> Prefers: Mia (Nails)
                  </span>
                  <div class="text-xs text-gray-500 mt-1 italic">Notes: Likes almond shape nails.</div>
                </td>
                <td class="p-5 text-center">
                  <div class="flex items-center justify-center gap-2">
                    <button class="w-8 h-8 rounded-lg bg-gray-50 border border-gray-200 text-primary hover:bg-primary hover:text-white hover:border-primary transition-colors flex items-center justify-center shadow-sm">
                      <span class="material-symbols-outlined text-sm">edit</span>
                    </button>
                    <button class="w-8 h-8 rounded-lg bg-gray-50 border border-gray-200 text-red-500 hover:bg-red-500 hover:text-white hover:border-red-500 transition-colors flex items-center justify-center shadow-sm">
                      <span class="material-symbols-outlined text-sm">delete</span>
                    </button>
                  </div>
                </td>
              </tr>
              <!-- Record 4 -->
              <tr class="hover:bg-gray-50/50 group">
                <td class="p-5">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-secondary/20 border border-secondary/50 flex items-center justify-center text-secondary font-serif font-bold text-lg shrink-0">EB</div>
                    <div>
                      <div class="font-bold text-primary text-base flex items-center gap-2">Emily Blunt <span class="bg-amber-100 text-amber-800 border border-amber-200 text-[9px] px-1.5 py-0.5 rounded uppercase tracking-wider font-bold">VIP</span></div>
                      <div class="text-xs text-gray-500">Member since 2023</div>
                    </div>
                  </div>
                </td>
                <td class="p-5">
                  <div class="text-gray-700 font-medium">e.blunt.pr@example.com</div>
                  <div class="text-xs text-gray-500 font-mono mt-0.5">+1 (310) 555-7771</div>
                </td>
                <td class="p-5">
                  <div class="text-gray-700 font-medium">28 Total Visits</div>
                  <div class="text-xs text-gray-500 mt-0.5">Last: Jul 8, 2026 (Makeup)</div>
                </td>
                <td class="p-5">
                  <span class="inline-block px-3 py-1 bg-green-50 text-primary border border-green-200 text-[11px] font-bold rounded-full mb-1">
                    <i class="fas fa-heart text-secondary mr-1"></i> Prefers: Victoria (Makeup)
                  </span><br>
                  <span class="inline-block px-3 py-1 bg-green-50 text-primary border border-green-200 text-[11px] font-bold rounded-full">
                    <i class="fas fa-heart text-secondary mr-1"></i> Prefers: Clarissa (Hair)
                  </span>
                </td>
                <td class="p-5 text-center">
                  <div class="flex items-center justify-center gap-2">
                    <button class="w-8 h-8 rounded-lg bg-gray-50 border border-gray-200 text-primary hover:bg-primary hover:text-white hover:border-primary transition-colors flex items-center justify-center shadow-sm">
                      <span class="material-symbols-outlined text-sm">edit</span>
                    </button>
                    <button class="w-8 h-8 rounded-lg bg-gray-50 border border-gray-200 text-red-500 hover:bg-red-500 hover:text-white hover:border-red-500 transition-colors flex items-center justify-center shadow-sm">
                      <span class="material-symbols-outlined text-sm">delete</span>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
 
  <!-- Modals (Hidden by Default) -->
  <!-- Add/Edit Client Modal -->
  <div id="clientModal" class="fixed inset-0 z-[100] modal-overlay hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl border border-secondary/20 overflow-hidden transform transition-all">
      <div class="bg-primary-container p-6 flex justify-between items-center text-white border-b border-secondary/30">
        <h3 class="font-serif text-2xl font-bold text-secondary">Client Profile Form</h3>
        <button class="text-white/60 hover:text-white transition-colors" onclick="document.getElementById('clientModal').classList.add('hidden')">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      <div class="p-8">
        <form class="space-y-6" onsubmit="event.preventDefault(); document.getElementById('clientModal').classList.add('hidden');">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Full Name</label>
              <input type="text" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="e.g. Penelope Cruz" required="">
            </div>
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Phone Number</label>
              <input type="tel" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="(123) 456-7890">
            </div>
          </div>
          <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Email Address</label>
            <input type="email" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="client@example.com" required="">
          </div>
          <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Stylist / Service Preferences</label>
            <input type="text" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="e.g. Prefers Marcus for Hair Styling">
          </div>
          <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Client Notes (Allergies, specifics)</label>
            <textarea class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700 h-24 resize-none" placeholder="Add any special instructions..."></textarea>
          </div>
          <!-- Actions -->
          <div class="flex items-center justify-end gap-4 mt-8 pt-4 border-t border-gray-100">
            <button type="button" class="px-6 py-3 border border-gray-300 text-gray-600 font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-gray-50 transition-colors" onclick="document.getElementById('clientModal').classList.add('hidden')">Cancel</button>
            <button type="submit" class="px-8 py-3 bg-secondary text-primary-container border border-secondary font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#EDD98A] transition-colors shadow-lg">Save Profile</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Delete Confirmation Modal -->
  <div id="deleteModal" class="fixed inset-0 z-[100] modal-overlay hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md border border-red-200 overflow-hidden transform transition-all text-center">
      <div class="p-8">
        <div class="w-16 h-16 rounded-full bg-red-50 text-red-500 border border-red-200 flex items-center justify-center text-3xl mx-auto mb-6">
          <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h3 class="font-serif text-2xl font-bold text-gray-800 mb-2">Delete Client Profile?</h3>
        <p class="text-sm text-gray-500 mb-8">This action cannot be undone. All appointment history and preferences will be permanently removed.</p>
        <div class="flex items-center justify-center gap-4">
          <button type="button" class="px-6 py-3 border border-gray-300 text-gray-600 font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-gray-50 transition-colors w-1/2" onclick="document.getElementById('deleteModal').classList.add('hidden')">Cancel</button>
          <button type="button" class="px-6 py-3 bg-red-500 text-white border border-red-600 font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-red-600 transition-colors shadow-lg w-1/2" onclick="document.getElementById('deleteModal').classList.add('hidden')">Delete Record</button>
        </div>
      </div>
    </div>
  </div>
@endsection