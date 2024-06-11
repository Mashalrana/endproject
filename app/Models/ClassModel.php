<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'class_name', 
        'mentor_id'
    ];

    public function mentor()
    {
        return $this->belongsTo(Teacher::class, 'mentor_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
