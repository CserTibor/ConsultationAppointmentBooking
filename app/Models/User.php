<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'contact',
        'code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function publishedAppointments()
    {
        return $this->belongsToMany(
            Appointment::class,
            'user_appointments',
            'appointment_id',
            'publisher_id',
            'id',
            'id'
        );
    }

    public function reservedAppointments()
    {
        return $this->belongsToMany(
            Appointment::class,
            'user_appointments',
            'appointment_id',
            'holder_id',
            'id',
            'id'
        )->withTimestamps();
    }

    public function isAdmin()
    {
        return $this->roles()->where('slug', '=', Role::ADMIN)->exists();
    }

    public function isTeacher()
    {
        return $this->roles()->where('slug', '=', Role::TEACHER)->exists();
    }
    public function isStudent()
    {
        return $this->roles()->where('slug', '=', Role::STUDENT)->exists();
    }
}
