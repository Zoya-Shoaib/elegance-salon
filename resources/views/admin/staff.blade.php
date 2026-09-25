@extends('admin.layouts.admin_layout')
@section('content')
    <!-- Content Area -->
    <div class="flex-grow p-4 sm:p-6 lg:p-8 overflow-y-auto scrollbar-lux">
      <div class="mb-8">
        <h2 class="font-serif text-3xl font-bold text-primary">Staff Management</h2>
        <p class="text-sm text-gray-500">Coordinate shifts, review task assignments, and track commission payouts.</p>
      </div>
      <!-- Section 1: Staff Directory Cards -->
      <div class="mb-8">
        <div class="flex justify-between items-center mb-4">
          <h3 class="font-serif text-xl font-bold text-primary">Stylist Directory &amp; Schedules</h3>
        <button
class="text-xs font-bold uppercase tracking-widest text-secondary hover:text-primary transition-colors flex items-center gap-1"
onclick="addStaff()">

    <span class="material-symbols-outlined text-sm">add</span>
    Add Staff
  </button>

        </div>
        
        <!-- Staff Card 1 -->
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          @foreach($staff as $member)
          <div class="bg-surface border border-secondary/20 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow text-center">
           <img src="{{ asset('staff_images/' .$member->profile_image) }}"  style="width:150px; height:150px; border-radius:50%; border:4px solid #d4af37; object-fit:cover;">
            <h4 class="font-bold text-primary text-lg">{{ $member->full_name }}</h4>
            <p class="text-[10px] uppercase tracking-widest font-bold text-secondary mb-3">{{ $member->role }}</p>
            <div class="text-xs text-gray-600 space-y-1 mb-4">
              <p><i class="fas fa-phone mr-1"></i>{{ $member->phone }}</p>
              <p><i class="fas fa-envelope mr-1"></i>{{ $member->email }}</p>
            </div>
            <div class="bg-primary/5 rounded-lg p-2 text-[10px] text-primary">
              <span class="font-bold block mb-1 uppercase tracking-wider border-b border-primary/10 pb-1">{{ $member->shift_days }}</span>
              <span>Mon, Tue, Thu, Fri (9am - 6pm)</span>
            </div>
            <div id="updatebtn" class="flex items-center justify-center gap-2">
                  <button
type="button"

onclick="editStaff(
'{{ $member->id }}',
'{{ $member->full_name }}',
'{{ $member->role }}',
'{{ $member->phone }}',
'{{ $member->email }}',
'{{ $member->commission_rate }}',
'{{ $member->shift_days }}'
)"

class="px-6 py-3 bg-secondary rounded-lg">

<i class="fas fa-user-edit"></i>

</button>

    <!-- <i class="fas fa-user-edit text-sm"></i> -->

                   <form action="{{ route('staff.destroy', $member->id) }}" method="POST" class="inline">
    @csrf
    @method('DELETE')

    <button type="submit"
        class="px-6 py-3 bg-secondary text-primary-container border border-secondary rounded-lg hover:bg-[#EDD98A] active:scale-[0.98] transition-all duration-200 shadow-md"
        title="Delete">

        <i class="fas fa-trash-alt text-sm"></i>
    </button>
</form>
                  </div>
            
          </div>
          @endforeach
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Section 2: Shift / Task Planner -->
</div>
          <h3 class="font-serif text-xl font-bold text-primary mb-4">Today's Task &amp; Shift Planner</h3>
          <div class="bg-surface border border-secondary/20 rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
              <table class="w-full text-left border-collapse min-w-[560px]">
                <thead>
                  <tr class="bg-gray-50 text-[10px] uppercase tracking-wider text-gray-500 border-b border-gray-100">
                    <th class="p-4 font-bold">Stylist</th>
                    <th class="p-4 font-bold">Shift Days</th>
                    <th class="p-4 font-bold">Focus / Specialty</th>
                  </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-50">
                  @forelse($staff as $member)
                  <tr class="hover:bg-gray-50/50">
                    <td class="p-4 font-bold text-primary">{{ $member->full_name }}</td>
                    <td class="p-4 text-xs font-mono text-gray-600">{{ $member->shift_days ?? 'TBD' }}</td>
                    <td class="p-4">
                      <span class="inline-block px-2 py-0.5 bg-blue-50 text-blue-700 text-[10px] rounded border border-blue-200">{{ ucfirst($member->role) }}</span>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="3" class="p-4 text-center text-gray-400 text-xs">No staff assigned today.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- Section 3: Commission Tracker -->
        <div>
          <div class="flex justify-between items-center mb-4">
            <h3 class="font-serif text-xl font-bold text-primary">Commission Payouts</h3>
            <span class="text-xs bg-secondary text-primary-container font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow">July 2026 Period</span>
          </div>
          <div class="bg-surface border border-secondary/20 rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
              <table class="w-full text-left border-collapse text-sm min-w-[540px]">
                <thead>
                  <tr class="bg-gray-50 text-[10px] uppercase tracking-wider text-gray-500 border-b border-gray-100">
                    <th class="p-4 font-bold">Stylist</th>
                    <th class="p-4 font-bold text-right">Service Revenue</th>
                    <th class="p-4 font-bold text-center">Comm. Rate</th>
                    <th class="p-4 font-bold text-right text-primary">Total Payout</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                  @php $totalSalesSum = 0; $totalPayoutSum = 0; @endphp
                  @forelse($commissionData ?? [] as $member)
                  @php
                    $payout = ($member->total_sales * ($member->commission_rate ?? 0)) / 100;
                    $totalSalesSum += $member->total_sales;
                    $totalPayoutSum += $payout;
                  @endphp
                  <tr class="hover:bg-gray-50/50">
                    <td class="p-4 font-bold text-gray-800">{{ $member->full_name }}</td>
                    <td class="p-4 text-right text-gray-600 font-mono">${{ number_format($member->total_sales, 2) }}</td>
                    <td class="p-4 text-center font-bold text-secondary">{{ $member->commission_rate ?? 0 }}%</td>
                    <td class="p-4 text-right font-bold text-primary font-mono bg-green-50/30">${{ number_format($payout, 2) }}</td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4" class="p-4 text-center text-gray-400 text-xs">No commission data available.</td>
                  </tr>
                  @endforelse
                </tbody>
                @if(($commissionData ?? collect())->count() > 0)
                <tfoot>
                  <tr class="bg-gray-50 border-t-2 border-gray-200 font-bold">
                    <td class="p-4 text-gray-800 uppercase text-xs tracking-wider">Period Totals</td>
                    <td class="p-4 text-right text-gray-600 font-mono">${{ number_format($totalSalesSum, 2) }}</td>
                    <td class="p-4 text-center text-gray-400">-</td>
                    <td class="p-4 text-right text-primary text-lg font-mono">${{ number_format($totalPayoutSum, 2) }}</td>
                  </tr>
                </tfoot>
                @endif
              </table>
            </div>
            <div class="p-4 border-t border-gray-100 flex justify-end">
              <button class="text-xs font-bold uppercase tracking-widest text-primary border border-primary px-4 py-2 rounded hover:bg-primary hover:text-white transition-colors">Generate Payroll Report</button>
            </div>
          </div>
        </div>
      </div>
    </div>
 
 <!-- Conversation with Gemini -->
 <!-- Add Staff Modal -->
  <div id="addStaffModal" class="fixed inset-0 z-[100] modal-overlay hidden flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl border border-secondary/20 overflow-hidden transform transition-all my-auto max-h-[90vh] flex flex-col">
      <div class="bg-primary-container p-6 flex justify-between items-center text-white border-b border-secondary/30">
  <h3 id="modalTitle" class="font-serif text-2xl font-bold text-secondary">
    Add New Staff Member
</h3>
        <button class="text-gray-500 hover:text-gray-700" onclick="document.getElementById('addStaffModal').classList.add('hidden')">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      <div class="p-5 sm:p-8 overflow-y-auto scrollbar-lux flex-grow">
<form   id="staffForm" action="{{ route('staff.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Full Name</label>
              <input type="text" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700"
               placeholder="e.g. Jane Doe" required="" id="full_name" name="full_name">
            </div>
           <div>
  <label for="role" class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">
    Role / Title <span class="text-red-400">*</span>
  </label>
  <select id="role" name="role" required
    class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700 transition-all duration-200 cursor-pointer">
    <option value="" disabled selected>Select a role...</option>
    <option value="stylist">Stylist</option>
    <option value="receptionist">Receptionist</option>
  </select>
</div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Email Address</label>
              <input type="email" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700"
               placeholder="jane@elegance.com" id="email" name="email" required="">
            </div>
             <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Password</label>
              <input type="password" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" 
              id="password" name="password" placeholder="e.g. aRd234/" required="">
            </div>
            
            
            
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Phone Number</label>
              <input type="tel" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" 
              placeholder="(555) 123-4567" id="phone" name="phone" required="">
            </div>
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Commission Rate (%)</label>
              <input type="number" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" 
              id="commission_rate" name="commission_rate"placeholder="e.g. 15" required="">
            </div>
           
            
          </div>

          <!-- NAYA ADDITION: Profile Image Input -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Standard Shift Days</label>
              <input type="text" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700" 
              placeholder="e.g. Mon, Wed, Fri" id="shift_days" name="shift_days" required="">
            </div>
            <div>
              <label class="block text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Profile Image</label>
              <input type="file" accept="image/*" class="w-full bg-background border border-secondary/30 rounded-lg px-4 py-2.5 text-sm focus:border-primary focus:ring-1 focus:ring-primary text-gray-700 file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-secondary file:text-primary-container hover:file:bg-[#EDD98A] file:transition-colors 
              file:cursor-pointer" name="profile_image">
            </div>
          </div>

          <div class="flex items-center justify-end gap-4 mt-8 pt-4 border-t border-gray-100">
            <button type="button" class="px-6 py-3 border border-gray-300 text-gray-600 font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-gray-50 transition-colors" onclick="document.getElementById('addStaffModal').classList.add('hidden')">Cancel</button>
            <button type="submit" id="saveBtn" class="px-8 py-3 bg-secondary text-primary-container border border-secondary font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#EDD98A] transition-colors shadow-lg">Save Staff Profile</button>
          </div>
        </form>
      </div>
    </div>
  </div>
   
  <script>
  
function editStaff(id, full_name, role, phone, email, commission_rate, shift_days)
{
  
    document.getElementById('addStaffModal').classList.remove('hidden');

  
    document.getElementById('modalTitle').innerHTML = "Update Staff Member";

  
    document.getElementById('full_name').value = full_name;
    document.getElementById('role').value = role;
    document.getElementById('phone').value = phone;
    document.getElementById('email').value = email;
    document.getElementById('commission_rate').value = commission_rate;
    document.getElementById('shift_days').value = shift_days;

    
    document.getElementById('staffForm').action = "/staff/update/" + id;

    
    document.getElementById('saveBtn').innerHTML = "Update Staff Profile";}

    function addStaff()
{
    document.getElementById('staffForm').reset();

    document.getElementById('staffForm').action = "{{ route('staff.store') }}";

    document.getElementById('modalTitle').innerHTML = "Add New Staff Member";

    document.getElementById('saveBtn').innerHTML = "Save Staff Profile";

    document.getElementById('addStaffModal').classList.remove('hidden');
}
</script>
  @endsection