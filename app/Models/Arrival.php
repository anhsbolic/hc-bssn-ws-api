<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrival extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'full_name',
        'passport_number',
        'nationality',
        'gender',
        'birth_date',
        'photo_path',
        'phone_number',
        'email',
        'stay_address',
        'flight_number',
        'arrival_date',
        'origin_city',
        'destination_city',
        'health_history',
        'emergency_contact_name',
        'emergency_contact_phone',
        'vaccine_certificate_path',
        'status',
        'approved_by_user_id',
        'rejected_by_user_id',
        'reject_reason'
    ];
}
