<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'user_type', 'university_id'];

    protected $hidden = ['password', 'remember_token'];

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }

    public function professor()
    {
        return $this->hasOne(Professor::class, 'user_id');
    }

    public function administrator()
    {
        return $this->hasOne(Administrator::class, 'user_id');
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'user_id');
    }
}
