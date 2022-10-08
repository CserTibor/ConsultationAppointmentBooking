<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const ADMIN = 'admin';
    public const TEACHER = 'teacher';
    public const STUDENT = 'student';

    public const ROLES = [
        self::ADMIN,
        self::TEACHER,
        self::STUDENT
    ];

    protected $fillable = [
        'slug',
        'name'
    ];
}
