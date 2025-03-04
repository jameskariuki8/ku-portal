<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'course_id', 'teacher_id'];

    // Define relationship with Teacher (User model)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Define relationship with Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
