<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['program_id', 'name', 'hod_id'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function hod()
    {
        return $this->belongsTo(User::class, 'hod_id');
    }
}
