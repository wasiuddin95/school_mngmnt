<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class AssignStudent extends Model
{
    /**
     * Get the user that owns the AssignStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }


    public function student_class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }


    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id', 'id');
    }
}
