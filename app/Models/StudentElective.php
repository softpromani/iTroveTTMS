<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentElective extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'elective_subject_id',
        'semester_id',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function electiveSubject()
    {
        return $this->belongsTo(ElectiveSubject::class, 'elective_subject_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
?>
