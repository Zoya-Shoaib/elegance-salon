<?php namespace App\Http\Controllers;
use App\Models\Client; 
use Illuminate\Http\RedirectResponse; 
use Illuminate\Http\Request; 
use Illuminate\View\View;
class ClientController extends Controller
{
public function index(Request $request): View
{
$query = Client::query()->latest(); if ($search = trim((string) $request->get('search', ''))) { $query->where(function ($builder) use ($search) {
$builder->where('name', 'like', "%{$search}%")
->orWhere('email', 'like', "%{$search}%")
->orWhere('phone', 'like', "%{$search}%");
});
}
if ($request->get('filter') === 'vip') { $query->where('is_vip', true);
} elseif ($request->get('filter') === 'recent') {
$query->where('last_visit_at', '>=', now()->subDays(30));
}
$clients = $query->get();
return view('admin.clients', compact('clients'));
}
public function store(Request $request): RedirectResponse
{
$data = $this->validatedData($request);
$data['is_vip'] = $request->boolean('is_vip');
$data['member_since'] = $data['member_since'] ?? now()->year;
$data['total_visits'] = $data['total_visits'] ?? 0;
Client::create($data);
return redirect()
->route('admin.clients')
->with('success', 'Client profile saved successfully.');
}
public function update(Request $request, Client $client): RedirectResponse
{
$data = $this->validatedData($request, $client->id);
$data['is_vip'] = $request->boolean('is_vip');
$client->update($data);
return redirect()
->route('admin.clients')
->with('success', 'Client profile updated successfully.');
}
public function destroy(Client $client): RedirectResponse
{
$client->delete();
return redirect()
->route('admin.clients')
->with('success', 'Client profile deleted successfully.');
}
private function validatedData(Request $request, ?int $clientId = null): array
{
return $request->validate([
'name' => ['required', 'string', 'max:255'],
'email' => ['required', 'email', 'max:255', 'unique:clients,email,'.($clientId ?? 'NULL')],
'phone' => ['nullable', 'string', 'max:50'],
'preferences' => ['nullable', 'string', 'max:255'],
'notes' => ['nullable', 'string'],
'is_vip' => ['nullable', 'boolean'],
'member_since' => ['nullable', 'integer', 'min:2000', 'max:2100'],
'total_visits' => ['nullable', 'integer', 'min:0'],
'last_visit_at' => ['nullable', 'date'],
'last_service' => ['nullable', 'string', 'max:255'],
]);
}
}