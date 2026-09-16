<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    protected $fillable=['name','category','stock_level','target_stock','supplier_name','coat_per_unit','is_active'];
    public function servicesAsProductOne()
    {
        return $this->hasMany(Service::class, 'product_id_1');
    }

   
    public function servicesAsProductTwo()
    {
        return $this->hasMany(Service::class, 'product_id_2');
    }

   
    public function servicesAsProductThree()
    {
        return $this->hasMany(Service::class, 'product_id_3');
    }
}
