<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $primaryKey = 'manager_id';

    protected $fillable = [
        'manager_name', 
        'manager_address', 
        'manager_postcode', 
        'manager_city'
    ];
}
