<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $fillable = [
        'client_id',
        'stylist_id',
        'service_id_1',
        'service_id_2',
        'service_id_3',
        'appointment_date',
        'appointment_time',
    ];

    // 1. Relationship to Client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // 2. Relationship to Staff
    public function stylist()
    {
        return $this->belongsTo(Staff::class, 'stylist_id');
    }

    // 3. Relationships to Services
    public function service1()
    {
        return $this->belongsTo(Service::class, 'service_id_1');
    }

    public function service2()
    {
        return $this->belongsTo(Service::class, 'service_id_2');
    }

    public function service3()
    {
        return $this->belongsTo(Service::class, 'service_id_3');
    }
}