@extends('admin.layouts.admin_layout')

@section('content')

<div class="flex-grow p-4 sm:p-6 lg:p-8 overflow-y-auto scrollbar-lux">
        <h2 class="font-serif text-2xl sm:text-4xl font-bold text-primary-container mb-4 sm:mb-6">
            Appointments List
        </h2>
        <div class="flex justify-between items-center mb-6">
        @if(session('success'))

<div class="w-full mb-4 p-4 rounded-lg bg-green-100 border border-green-400 text-green-700">

    {{ session('success') }}

</div>

@endif
    </div>
    

   <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-secondary/20">
<div class="overflow-x-auto scrollbar-lux">
        <table class="w-full min-w-[750px]">

            <thead class="bg-primary-container text-white">

                <tr>

                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-secondary">
                        ID
                    </th>

                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-secondary">
                        Client
                    </th>

                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-secondary">
                        Stylist
                    </th>

                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-secondary">
                        Services
                    </th>

                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-secondary">
                        Date
                    </th>

                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-secondary">
                        Time
                    </th>
                    <th class="px-6 py-4 text-center text-xs uppercase tracking-widest text-secondary">
                    Actions
                 </th>

                </tr>

            </thead>

            <tbody>

                @forelse($appointments as $appointment)

                <tr class="border-b border-secondary/20 hover:bg-secondary/10 transition-all duration-200">

                    <td class="px-6 py-5 font-semibold text-primary-container">
                        {{ $appointment->id }}
                    </td>

                    <td class="px-6 py-5 text-gray-700">
                         {{ $appointment->client?->name??"N/A" }}
                    </td>

                    <td class="px-6 py-5 text-gray-700">
                          {{ $appointment->stylist?->name??"N/A" }}
                    </td>

                    <td class="px-6 py-5 text-gray-700">
                         {{ $appointment->service1?->name??"N/A" }}, {{ $appointment->service2?->name??"N/A" }}, {{ $appointment->service3?->name??"N/A" }}
                    </td>
                    
                    

                    <td class="px-6 py-5 text-gray-700">
                        {{ $appointment->appointment_date }}
                    </td>

                    <td class="px-6 py-5 text-gray-700">
                        {{ date('h:i A', strtotime($appointment->appointment_time)) }}
                    </td>
                   <td class="px-6 py-5 text-center">

    <div class="flex justify-center gap-2">

        <button
            onclick="editAppointment(
                '{{ $appointment->id }}',
                '{{ $appointment->client_id }}',
                '{{ $appointment->stylist_id }}',
                '{{ $appointment->service_id_1 }}',
                '{{ $appointment->service_id_2 ?? `null`}}',
                '{{ $appointment->service_id_3 ?? `null`}}',
                '{{ $appointment->appointment_date }}',
                '{{ $appointment->appointment_time }}'
            )"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow">

            <i class="fas fa-edit mr-1"></i>
            Edit

        </button>

        <form action="{{ route('appointments.destroy',$appointment->id) }}"
              method="POST"
              onsubmit="return confirm('Delete this appointment?')">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow">

                <i class="fas fa-trash mr-1"></i>
                Delete

            </button>
        </form>
    </div>
</td>
                </tr>
                @empty
                <tr>

                    <td colspan="7" class="text-center py-10 text-gray-500">

                        No appointments found.

                    </td>

                </tr>

                @endforelse
            </tbody>
        </table>
    </div>
   </div>

</div>
<div id="editModal" class="fixed inset-0 hidden bg-black/50 flex items-center justify-center z-50 p-4 overflow-y-auto">
    <div class="bg-white rounded-2xl w-full max-w-xl p-5 sm:p-8 max-h-[90vh] overflow-y-auto my-auto">
        <h2 class="text-xl sm:text-2xl font-bold text-primary-container mb-6">
            Update Appointment
        </h2>

        <form id="editForm" method="POST">
            @csrf
           

            <div class="space-y-5">
                <!-- Client Selection -->
                <div>
                    <label class="block text-xs font-bold uppercase mb-2">Client</label>
                    <select name="client_id" id="edit_client_id" class="w-full border rounded-lg p-3">
                        <option value="">Select Client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Stylist Selection -->
                <div>
                    <label class="block text-xs font-bold uppercase mb-2">Stylist</label>
                    <select name="stylist_id" id="edit_stylist_id" class="w-full border rounded-lg p-3">
                        <option value="">Select Stylist</option>
                        @foreach ($staff as $stf)
                            @if ($stf->role === 'stylist')
                                <option value="{{ $stf->id }}">{{ $stf->full_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Service 1 (Required) -->
                <div>
                    <label class="block text-xs font-bold uppercase mb-2">Service Requested 1</label>
                    <select name="service_id_1" id="edit_service_id_1" class="w-full border rounded-lg p-3" required>
                        <option value="">Select Service 1</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Service 2 (Optional) -->
                <div>
                    <label class="block text-xs font-bold uppercase mb-2">Service Requested 2 (Optional)</label>
                    <select name="service_id_2" id="edit_service_id_2" class="w-full border rounded-lg p-3">
                        <option value="">Select Service 2</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Service 3 (Optional) -->
                <div>
                    <label class="block text-xs font-bold uppercase mb-2">Service Requested 3 (Optional)</label>
                    <select name="service_id_3" id="edit_service_id_3" class="w-full border rounded-lg p-3">
                        <option value="">Select Service 3</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date -->
                <div>
                    <label class="block text-xs font-bold uppercase mb-2">Date</label>
                    <input type="date" id="edit_date" name="appointment_date" class="w-full border rounded-lg p-3">
                </div>

                <!-- Time -->
                <div>
                    <label class="block text-xs font-bold uppercase mb-2">Time</label>
                    <input type="time" id="edit_time" name="appointment_time" class="w-full border rounded-lg p-3">
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 mt-8">
                <button type="button" onclick="closeModal()" class="px-5 py-2 border rounded-lg">
                    Cancel
                </button>
                <button type="submit" class="px-6 py-2 bg-secondary text-primary-container rounded-lg">
                    Update Appointment
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function editAppointment(id, client, stylist, service1, service2, service3, date, time) {
    document.getElementById('editModal').classList.remove('hidden');

    // Update form submit action
    document.getElementById('editForm').action = "/appointments/update/" + id;

    // Set dynamic values matching DB column IDs
    document.getElementById('edit_client_id').value = client ?? '';
    document.getElementById('edit_stylist_id').value = stylist ?? '';
    document.getElementById('edit_service_id_1').value = service1 ?? '';
    document.getElementById('edit_service_id_2').value = service2 ?? '';
    document.getElementById('edit_service_id_3').value = service3 ?? '';
    document.getElementById('edit_date').value = date ?? '';
    document.getElementById('edit_time').value = time ?? '';
}

function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
}

</script>
@endsection