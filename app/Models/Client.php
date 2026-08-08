<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'preferences',
        'notes',
        'is_vip',
        'member_since',
        'total_visits',
        'last_visit_at',
        'last_service',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_vip' => 'boolean',
            'last_visit_at' => 'date',
            'total_visits' => 'integer',
            'member_since' => 'integer',
        ];
    }

    /**
     * Get the client's initials.
     */
    protected function initials(): Attribute
    {
        return Attribute::get(function (): string {
            $parts = preg_split('/\s+/', trim($this->name)) ?: [];

            $letters = collect($parts)
                ->filter()
                ->take(2)
                ->map(fn (string $part) => mb_strtoupper(mb_substr($part, 0, 1)))
                ->implode('');

            return $letters !== '' ? $letters : 'CL';
        });
    }
    public function appointments(){
        return $this->hasMany(Appointments::class,'client_id');
    }
    public function orders()
{
    return $this->hasMany(Orders::class, 'client_id');
}
}