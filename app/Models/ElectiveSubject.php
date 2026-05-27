<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectiveSubject extends Model
{
    use HasFactory;

    protected $fillable = ['elective_group_id', 'subject_id', 'mandatory_flag'];

    public function electiveGroup()
    {
        return $this->belongsTo(ElectiveGroup::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
?>
