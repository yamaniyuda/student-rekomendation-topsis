<?php

namespace App\Observers;

use App\Models\Student;

class StudentObserve
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        //
    }
}
