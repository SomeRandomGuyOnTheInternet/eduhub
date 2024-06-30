<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    protected $fillable = ['first_name', 'last_name', 'email', 'date_of_birth', 'password', 'user_type', 'university_id'];

    protected $hidden = ['password', 'remember_token'];
    protected $appends = ['name'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function administrator()
    {
        return $this->hasOne(Administrator::class, 'user_id');
    }

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public static function getUsersByType($type)
    {
        return self::where('user_type', $type)->get()->pluck('name', 'user_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id');
    }
    
    public function teaches()
    {
        return $this->hasMany(Teaches::class, 'user_id');
    }
}