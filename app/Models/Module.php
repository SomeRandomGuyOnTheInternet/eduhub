<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $primaryKey = 'module_id';
    protected $fillable = ['module_name', 'module_code', 'description', 'credits', 'logo', 'professor_id', 'faculty_id'];

    public function professor()
    {
        return $this->belongsTo(Professor::class, 'professor_id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'module_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'module_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'module_id');
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'module_id');
    }

    public function moduleContents()
    {
        return $this->hasMany(ModuleContent::class, 'module_id');
    }

   