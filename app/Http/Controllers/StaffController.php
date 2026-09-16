<?php

namespace App\Http\Controllers;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
   public function store(Request $request)
     {

    $imageName = null;
    if($request->hasFile('profile_image'))
    {
        $imageName = time().'.'.$request->profile_image->extension();

        $request->profile_image->move(public_path('staff_images'),$imageName);
    }

    Staff::create([
        'full_name'=>$request->full_name,
        'role'=>$request->role,

        'phone'=>$request->phone,

        'email'=>$request->email,

        'commission_rate'=>$request->commission_rate,

        'shift_days'=>$request->shift_days,

        'profile_image'=>$imageName
   ]);
   User::create([
                'name'=>$request->full_name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => $request->role,
            ]);
    return redirect()->route('admin.staff');     }

   public function update(Request $request, $id)
{
    $staff = Staff::findOrFail($id);

    $staff->update([

        'full_name'=>$request->full_name,

        'role'=>$request->role,

        'phone'=>$request->phone,

        'email'=>$request->email,

        'commission_rate'=>$request->commission_rate,

        'shift_days'=>$request->shift_days

    ]);

    return redirect()->route('admin.staff');
}
public function destroy($id)
{
    $staff = Staff::findOrFail($id);

    $staff->delete();

    return redirect()->back();
}}