<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleContent extends Model
{
    use HasFactory;

    protected $primaryKey = 'content_id';
    // protected $fillable = ['module_folder_id', 'title', 'description', 'file_path', 'visited'];
    protected $fillable = ['module_folder_id', 'title', 'description', 'file_path', 'visited'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_folder_id');
    }
}