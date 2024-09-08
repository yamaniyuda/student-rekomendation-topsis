<?php

namespace App\Livewire;

use App\Models\Student;
use App\Models\Criteria;
use Livewire\Component;

class ShowStudent extends Component
{
    public string $id;
    public ?Student $student;

    public function mount()
    {
        $this->student = Student::with(['user', 'studentScore', 'studentScore.criteriaDetails.criteria'])->find($this->id);
    }


    public function getCrietria()
    {
        return $this->student->getCrietriaTable();
    }


    public function render()
    {
        return view('livewire.show-student');
    }
}
