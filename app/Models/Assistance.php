<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assistance extends Model
{
    use HasFactory, SoftDeletes;

    protected  $fillable = [
        'client_id',
        'patient_id',
        'relation_patient',
        'assistance',
        'category',
        'amount',
        'hospital',
        'hospital_address',
        'doctor_name',
        'diagnosis',
        'date_time_requested',
        'date_approved',
        'remarks',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
