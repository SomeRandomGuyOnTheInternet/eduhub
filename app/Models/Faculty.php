<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $primaryKey = 'faculty_id';

    public function students()
    {
        return $this->hasMany(Student::class, 'faculty_id');
    }

    public function professors()
    {
        return $this->hasMany(Professor::class, 'faculty_id');
    }

    public function modules()
    {
        return $this->hasMany(Module::class, 'faculty_id');
    }
}