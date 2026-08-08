<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name','category','description','base_price','product_id_1','product_id_2','product_id_3','total_price'];
    public function productOne()
    {
        return $this->belongsTo(Inventory::class, 'product_id_1');
    }

    public function productTwo()
    {
        return $this->belongsTo(Inventory::class, 'product_id_2');
    }

    public function productThree()
    {
        return $this->belongsTo(Inventory::class, 'product_id_3');
    }
    public function appointmentsAsService1(){
        return $this->hasMany(Appointments::class,'service_id_1');
    }
    public function appointmentsAsService2(){
        return $this->hasMany(Appointments::class,'service_id_2');
    }
    public function appointmentsAsService3(){
        return $this->hasMany(Appointments::class,'service_id_3');
    }
    public function ordersAsService1(){
        return $this->hasMany(Orders::class,'service_id_1');
    }
    public function ordersAsService2(){
        return $this->hasMany(Orders::class,'service_id_2');
    }
    public function ordersAsService3(){
        return $this->hasMany(Orders::class,'service_id_3');
    }
}
