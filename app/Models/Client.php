<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'barangay',
        'municipality',
        'province'
    ];

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function assistances(){
       return $this->hasMany(Assistance::class); 
    }
}
