@extends('admin.layouts.admin_layout')

@section('content')

    <!-- Content Area -->
    <div class="flex-grow p-8 overflow-y-auto scrollbar-lux" 
         id="clientsContainer" 
         data-store-url="{{ route('admin.clients.store') }}" 
         data-update-url="{{ url('/admin-clients') }}">
      
      <!-- Top Actions & Search -->
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
        <div>
          <h2 class="font-serif text-3xl font-bold text-primary">Clients Directory</h2>
          <p class="text-sm text-gray-500">Manage client profiles, preferences, and visit history.</p>
        </div>
        <div class="flex flex-col sm:flex-row items-center gap-4">
          <!-- Search & Filter -->
          <form method="GET" action="{{ route('admin.clients') }}" class="flex border border-secondary/30 rounded-full bg-surface shadow-sm overflow-hidden h-12 w-full sm:w-auto">
            <div class="px-4 flex items-center text-gray-400 bg-gray-50 border-r border-secondary/30">
              <i class="fas fa-search"></i>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..." class="border-none focus:ring-0 px-4 py-2 w-64 text-sm text-gray-700 bg-transparent">
            <select name="filter" onchange="this.form.submit()" class="border-none focus:ring-0 bg-gray-50 text-sm font-semibold border-l border-secondary/30 text-primary cursor-pointer px-4">
              <option value="">All Clients</option>
              <option value="vip" @selected(request('filter') === 'vip')>VIP Members</option>
              <option value="recent" @selected(request('filter') === 'recent')>Recent Visitors</option>
            </select>
          </form>
          <!-- Add Button -->
          <button type="button" class="bg-secondary text-primary-container font-bold text-xs px-6 py-3 h-12 rounded-full hover:bg-[#EDD98A] transition-colors flex items-center gap-2 shadow-lg w-full sm:w-auto justify-center" onclick="openClientModal()">
            <span class="material-symbols-outlined text-sm">person_add</span>
            <span>Register Client</span>
          </button>
        </div>
      </div>

      @if (session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
          {{ session('success') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
          <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

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
              @forelse ($clients as $client)
              <tr class="hover:bg-gray-50/50 group">
                <td class="p-5">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full {{ $client->is_vip ? 'bg-secondary/20 border border-secondary/50 text-secondary' : 'bg-primary/10 border border-primary/20 text-primary' }} flex items-center justify-center font-serif font-bold text-lg shrink-0">{{ $client->initials }}</div>
                    <div>
                      <div class="font-bold text-primary text-base flex items-center gap-2">
                        {{ $client->name }}
                        @if ($client->is_vip)
                          <span class="bg-amber-100 text-amber-800 border border-amber-200 text-[9px] px-1.5 py-0.5 rounded uppercase tracking-wider font-bold">VIP</span>
                        @endif
                      </div>
                      <div class="text-xs text-gray-500">Member since {{ $client->member_since ?? $client->created_at?->format('Y') }}</div>
                    </div>
                  </div>
                </td>
                <td class="p-5">
                  <div class="text-gray-700 font-medium">{{ $client->email }}</div>
                  <div class="text-xs text-gray-500 font-mono mt-0.5">{{ $client->phone ?: '—' }}</div>
                </td>
                <td class="p-5">
                  <div class="text-gray-700 font-medium">{{ $client->total_visits }} Total {{ $client->total_visits === 1 ? 'Visit' : 'Visits' }}</div>
                  <div class="text-xs text-gray-500 mt-0.5">
                    @if ($client->last_visit_at)
                      Last: {{ $client->last_visit_at->format('M j, Y') }}{{ $client->last_service ? ' ('.$client->last_service.')' : '' }}
                    @else
                      No visits yet
                    @endif
                  </div>
                </td>
                <td class="p-5">
                  @if ($client->preferences)
                    <span class="inline-block px-3 py-1 bg-green-50 text-primary border border-green-200 text-[11px] font-bold rounded-full">
                      <i class="fas fa-heart text-secondary mr-1"></i> {{ $client->preferences }}
                    </span>
                  @endif
                  @if ($client->notes)
                    <div class="text-xs text-gray-500 mt-1 italic">Notes: {{ $client->notes }}</div>
                  @endif
                </td>
                <td class="p-5 text-center">
                  <div class="flex items-center justify-center gap-2">
                    <button type="button"
                      class="edit-client-btn w-8 h-8 rounded-lg bg-gray-50 border border-gray-200 text-primary hover:bg-primary hover:text-white hover:border-primary transition-colors flex items-center justify-center shadow-sm"
                      data-client="{{ json_encode($client) }}">
                      <span class="material-symbols-outlined text-sm">edit</span>
                    </button>
                    <button type="button"
                      class="delete-client-btn w-8 h-8 rounded-lg bg-gray-50 border border-gray-200 text-red-500 hover:bg-red-500 hover:text-white hover:border-red-500 transition-colors flex items-center justify-center shadow-sm"
                      data-id="{{ $client->id }}"
                      data-name="{{ $client->name }}">
                      <span class="material-symbols-outlined text-sm">delete</span>
                    </button>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="p-10 text-center text-gray-500">
                  No clients found. Click <strong>Register Client</strong> to add one.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

  <!-- Modals (Hidden by Default) -->
  <!-- Add/Edit Client Modal (Responsive & Scrollable) -->
  <div id="clientModal" class="fixed inset-0 z-[100] modal-overlay hidden flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm overflow-y-auto">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl border border-secondary/20 overflow-hidden transform transition-all my-auto max-h-[90vh] flex flex-col">
      
      <!-- Sticky Header -->
      <div class="bg-primary-container p-5 flex justify-between items-center text-white border-b border-secondary/30 shrink-0">
        <h3 id="clientModalTitle" class="font-serif text-xl font-bold text-secondary">Client Profile Form</h3>
        <button type="button" class="text-white/60 hover:text-white transition-colors" onclick="closeClientModal()">
          <i class="fas fa-times text-lg"></i>
        </button>
      </div>

      <!-- Scrollable Form Body -->
      <div class="p-6 overflow-y-auto scrollbar-lux flex-1">
        <form id="clientForm" method="POST" action="{{ route('admin.clients.store') }}" class="space-y-4">
          @csrf
          <input type="hidden" name="_method" id="clientFormMethod" value="POST">

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-1">Full Name</label>
              <input type="text" name="name" id="client_name" class="w-full bg-background border border-secondary/30 rounded-lg px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="e.g. Penelope Cruz" required>
            </div>
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-1">Phone Number</label>
              <input type="tel" name="phone" id="client_phone" class="w-full bg-background border border-secondary/30 rounded-lg px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="(123) 456-7890">
            </div>
          </div>

          <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-1">Email Address</label>
            <input type="email" name="email" id="client_email" class="w-full bg-background border border-secondary/30 rounded-lg px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="client@example.com" required>
          </div>

          <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-1">Stylist / Service Preferences</label>
            <input type="text" name="preferences" id="client_preferences" class="w-full bg-background border border-secondary/30 rounded-lg px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="e.g. Prefers Marcus for Hair Styling">
          </div>

          <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-1">Client Notes (Allergies, specifics)</label>
            <textarea name="notes" id="client_notes" class="w-full bg-background border border-secondary/30 rounded-lg px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700 h-20 resize-none" placeholder="Add any special instructions..."></textarea>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-1">Member Since (Year)</label>
              <input type="number" name="member_since" id="client_member_since" min="2000" max="2100" class="w-full bg-background border border-secondary/30 rounded-lg px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="{{ date('Y') }}">
            </div>
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-1">Total Visits</label>
              <input type="number" name="total_visits" id="client_total_visits" min="0" class="w-full bg-background border border-secondary/30 rounded-lg px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="0">
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-1">Last Visit Date</label>
              <input type="date" name="last_visit_at" id="client_last_visit_at" class="w-full bg-background border border-secondary/30 rounded-lg px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700">
            </div>
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-1">Last Service</label>
              <input type="text" name="last_service" id="client_last_service" class="w-full bg-background border border-secondary/30 rounded-lg px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" placeholder="e.g. Balayage">
            </div>
          </div>

          <div class="pt-2">
            <label class="inline-flex items-center gap-2 text-sm text-primary font-medium cursor-pointer">
              <input type="checkbox" name="is_vip" id="client_is_vip" value="1" class="rounded border-secondary/40 text-secondary focus:ring-secondary">
              Mark as VIP Member
            </label>
          </div>

          <!-- Actions Footer (Always Visible/Sticky Bottom) -->
          <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
            <button type="button" class="px-5 py-2.5 border border-gray-300 text-gray-600 font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-gray-50 transition-colors" onclick="closeClientModal()">Cancel</button>
            <button type="submit" class="px-6 py-2.5 bg-secondary text-primary-container border border-secondary font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#EDD98A] transition-colors shadow-lg">Save Profile</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div id="deleteModal" class="fixed inset-0 z-[100] modal-overlay hidden flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm overflow-y-auto">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md border border-red-200 overflow-hidden transform transition-all text-center my-auto">
      <div class="p-6">
        <div class="w-14 h-14 rounded-full bg-red-50 text-red-500 border border-red-200 flex items-center justify-center text-2xl mx-auto mb-4">
          <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h3 class="font-serif text-xl font-bold text-gray-800 mb-2">Delete Client Profile?</h3>
        <p class="text-xs text-gray-500 mb-2">This action cannot be undone. All appointment history and preferences will be permanently removed.</p>
        <p id="deleteClientName" class="text-sm font-bold text-primary mb-6"></p>
        <form id="deleteForm" method="POST" action="">
          @csrf
          @method('DELETE')
          <div class="flex items-center justify-center gap-3">
            <button type="button" class="px-5 py-2.5 border border-gray-300 text-gray-600 font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-gray-50 transition-colors w-1/2" onclick="closeDeleteModal()">Cancel</button>
            <button type="submit" class="px-5 py-2.5 bg-red-500 text-white border border-red-600 font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-red-600 transition-colors shadow-lg w-1/2">Delete Record</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Clean JavaScript Block -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const container = document.getElementById('clientsContainer');
      const storeUrl = container ? container.dataset.storeUrl : '';
      const updateUrlTemplate = container ? container.dataset.updateUrl : '';

      // Edit Button Listener
      document.querySelectorAll('.edit-client-btn').forEach(button => {
        button.addEventListener('click', function () {
          const clientData = JSON.parse(this.dataset.client);
          openClientModal(clientData);
        });
      });

      // Delete Button Listener
      document.querySelectorAll('.delete-client-btn').forEach(button => {
        button.addEventListener('click', function () {
          const id = this.dataset.id;
          const name = this.dataset.name;
          openDeleteModal(id, name);
        });
      });

      window.openClientModal = function(client = null) {
        const form = document.getElementById('clientForm');
        const methodInput = document.getElementById('clientFormMethod');
        const title = document.getElementById('clientModalTitle');

        form.reset();
        document.getElementById('client_is_vip').checked = false;

        if (client) {
          title.textContent = 'Edit Client Profile';
          form.action = `${updateUrlTemplate}/${client.id}`;
          methodInput.value = 'PUT';
          document.getElementById('client_name').value = client.name || '';
          document.getElementById('client_phone').value = client.phone || '';
          document.getElementById('client_email').value = client.email || '';
          document.getElementById('client_preferences').value = client.preferences || '';
          document.getElementById('client_notes').value = client.notes || '';
          document.getElementById('client_member_since').value = client.member_since || '';
          document.getElementById('client_total_visits').value = client.total_visits ?? 0;
          document.getElementById('client_last_visit_at').value = client.last_visit_at ? String(client.last_visit_at).substring(0, 10) : '';
          document.getElementById('client_last_service').value = client.last_service || '';
          document.getElementById('client_is_vip').checked = !!client.is_vip;
        } else {
          title.textContent = 'Client Profile Form';
          form.action = storeUrl;
          methodInput.value = 'POST';
          document.getElementById('client_member_since').value = new Date().getFullYear();
          document.getElementById('client_total_visits').value = 0;
        }

        document.getElementById('clientModal').classList.remove('hidden');
      };

      window.closeClientModal = function() {
        document.getElementById('clientModal').classList.add('hidden');
      };

      window.openDeleteModal = function(id, name) {
        document.getElementById('deleteForm').action = `${updateUrlTemplate}/${id}`;
        document.getElementById('deleteClientName').textContent = name;
        document.getElementById('deleteModal').classList.remove('hidden');
      };

      window.closeDeleteModal = function() {
        document.getElementById('deleteModal').classList.add('hidden');
      };
    });
  </script>

  @if ($errors->any())
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        if (typeof openClientModal === 'function') {
          openClientModal();
        }
      });
    </script>
  @endif

@endsection