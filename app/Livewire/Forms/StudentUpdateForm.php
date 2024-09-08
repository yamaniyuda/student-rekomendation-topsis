<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StudentUpdateForm extends Form
{
    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $gender;

    #[Validate('required')]
    public $address;

    #[Validate('required')]
    public $email;

    public function update($id)
    {
        $student = Student::find($id);
        $student->gender = $this->gender;
        $student->address = $this->address;
        $student->save();

        $student->user->name = $this->name;
        $student->user->email = $this->email;
        $student->user->save();
    }
}
