<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'date_of_birth',
        'division',
        'district',
        'upazilla',
        'union',
        'word',
        'gender',
        'address',
        'phone',
        'nid_or_birth_certificate',
        'blood_group',
    ];
}
