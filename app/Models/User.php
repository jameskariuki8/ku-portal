<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;
use App\Models\Enrollment;
use App\Models\Unit;
use App\Models\Course;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationship: A student has many enrollments (via pivot)
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    // A student is enrolled in many courses
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id');
    }
    // A student registers for multiple units
    public function registeredUnits()
    {
        return $this->belongsToMany(Unit::class, 'unit_registrations', 'student_id', 'unit_id')
                    ->withPivot('marks', 'grade');
    }
    
    
    // Ensuring Password Hashing
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->password = Hash::make($user->password);
        });
        static::updating(function ($user) {
            if ($user->isDirty('password')) {
                $user->password = Hash::make($user->password);
            }
        });
    }
}
