<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $primaryKey = 'assignment_id';
    protected $fillable = ['module_id', 'title', 'weightage', 'description', 'due_date'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'assignment_id');
    }
}