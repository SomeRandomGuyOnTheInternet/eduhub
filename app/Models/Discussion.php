<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $primaryKey = 'discussion_id';
    protected $fillable = ['module_id', 'user_id', 'content'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}