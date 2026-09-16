@extends('admin.layouts.admin_layout')
@section('content')
<div class="flex-grow p-8 overflow-y-auto scrollbar-lux">
  <div class="mb-8">
    <h2 class="font-serif text-3xl font-bold text-primary">Website Feedback</h2>
    <p class="text-sm text-gray-500">View and manage user feedback and bug reports.</p>
  </div>

  <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-primary-container text-white text-xs uppercase tracking-wider">
            <th class="p-4 font-medium">Name</th>
            <th class="p-4 font-medium">Email</th>
            <th class="p-4 font-medium">Page</th>
            <th class="p-4 font-medium">Rating</th>
            <th class="p-4 font-medium">Message</th>
            <th class="p-4 font-medium">Date</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm">
          @foreach($feedbacks as $fb)
          <tr class="hover:bg-gray-50 transition-colors">
            <td class="p-4 font-semibold text-primary">{{ $fb->name }}</td>
            <td class="p-4 text-gray-600">{{ $fb->email }}</td>
            <td class="p-4">
              <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-medium">{{ $fb->page ?? 'N/A' }}</span>
            </td>
            <td class="p-4">
              <div class="flex text-secondary text-xs">
                @for($i = 0; $i < $fb->rating; $i++)
                  <i class="fas fa-star"></i>
                @endfor
              </div>
            </td>
            <td class="p-4 text-gray-600 max-w-xs truncate">{{ $fb->message }}</td>
            <td class="p-4 text-gray-500 text-xs">{{ $fb->created_at->format('M d, Y') }}</td>
          </tr>
          @endforeach

          @if($feedbacks->isEmpty())
          <tr>
            <td colspan="6" class="p-8 text-center text-gray-500">No feedback received yet.</td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
