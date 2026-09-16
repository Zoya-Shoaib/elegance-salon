<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [ 'full_name','role','phone','email','commission_rate','shift_days',
    'profile_image'

];
public function appointments(){
    return $this->hasMany(Appointments::class,'stylist_id');
}
public function orders()
{
    return $this->hasMany(Orders::class, 'staff_id');
}
}
