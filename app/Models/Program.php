<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['name', 'type', 'duration', 'status'];
    
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
