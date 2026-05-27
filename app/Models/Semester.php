<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'program_id', 'academic_year', 'name', 
        'start_date', 'end_date', 'duration_weeks'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
