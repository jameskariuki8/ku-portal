<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;

    protected $table = 'marks'; // Ensure it matches your table name

    protected $fillable = ['student_id', 'unit_id', 'marks', 'grade'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
