<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\ElectiveSubject;
#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /**
    * The electives the student is enrolled in.
    */


    /**
    * The electives the student is enrolled in.
    */
    public function electives()
    {
        return $this->belongsToMany(
            ElectiveSubject::class,
            'student_electives',
            'student_id',
            'elective_subject_id'
        );
    }

    /**
     * Get total elective credits the student has enrolled in.
     */
    public function totalElectiveCredits(): int
    {
        return $this->electives()
            ->with('subject')
            ->get()
            ->sum(fn($e) => $e->subject->credits ?? 0);
    }

}
