<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spy extends Model
{
    use HasFactory;

    protected $table = 'spies';

    protected $fillable = [
        'name',
        'surname',
        'agency',
        'country_of_operation',
        'dob',
        'bob'
    ];
}
