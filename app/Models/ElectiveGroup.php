<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectiveGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'min_credits', 'max_credits'];

    public function electiveSubjects()
    {
        return $this->hasMany(ElectiveSubject::class);
    }
}
?>
