<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_name', 
        'teacher_address', 
        'teacher_postcode', 
        'teacher_city'
    ];

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'mentor_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}
