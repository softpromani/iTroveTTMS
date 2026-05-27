<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'department_id', 'subject_code', 'subject_name', 
        'credits', 'lecture_hours', 'tutorial_hours', 'practical_hours'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
