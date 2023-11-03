<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'membership_number', 
        'user_id',
        'maritalstatus_id',
        'department_id', 
        'country_id',
        'prayercell_id',
        'membershiptype_id', 
        'sex',
        'birthdate',
        'address', 
        'phone_number',
        'join_date',
        'photo',
    ];
}
