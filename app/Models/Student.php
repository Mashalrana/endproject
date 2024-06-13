<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name', 
        'student_address', 
        'student_postcode', 
        'student_city', 
        'class_id' // Ensure this is correct
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id'); // Ensure this is correct
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}
