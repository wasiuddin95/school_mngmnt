<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    /**
     * Get the user that owns the AssignSubject
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student_class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
