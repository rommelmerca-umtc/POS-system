<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address',
    ];
    
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
