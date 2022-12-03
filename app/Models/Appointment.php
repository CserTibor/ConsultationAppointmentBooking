<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_reserved',
        'date',
        'length'
    ];

    public function getDateAttribute()
    {
        return Carbon::parse($this->attributes['date'])->format('Y.m.d H:m:s');
    }

    public function publishers()
    {
        return $this->belongsToMany(
            User::class,
            'user_appointments',
            'appointment_id',
            'publisher_id',
            'id',
            'id'
        )->withTimestamps();
    }

    public function holders()
    {
        return $this->belongsToMany(
            User::class,
            'user_appointments',
            'appointment_id',
            'holder_id',
            'id',
            'id'
        )->withTimestamps();
    }

    public function types()
    {
        return $this->belongsToMany(
            Type::class,
            'appointment_types',
            'appointment_id',
            'type_id',
            'id',
            'id'
        )->withTimestamps();
    }
}
