<?php

namespace App\Livewire;

use App\Livewire\Forms\StudentForm;
use App\Livewire\Table\Column;
use App\Livewire\Table\Table;
use App\Models\Criteria;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithFileUploads;

class StudentTable extends Table
{
    use WithFileUploads;

    public string $name = 'student-table';
    public string $title = 'Siswa';
    public string $desc = 'Data siswa dan siswi yang terdaftar kamu dapat menambahkan data siswa siswi baru dengan menekan tombol tambah dan kamu dapat melihat detail dari siswa siswi dengan menekan tombol detail';
    public ?string $studentIdUpdate = null;

    public StudentForm $form;


    public function save()
    {
        if ($this->studentIdUpdate) {
            $this->form->update($this->studentIdUpdate);
        } else {
            $this->form->store();
        }
        $this->studentIdUpdate = null;
        return $this->showModal = false;
    }



    public function query(): Builder
    {
        return User::has('student')->with([
            'student.studentScore' => function ($q) {
                $q
                    ->where('year', Carbon::now()->year)
                    ->with([
                        'criteriaDetails' => function ($q) {
                            $q->with(['criteria']);
                        }
                    ]);
            }
        ]);
    }


    public function getCriteria()
    {
        return Criteria::with('criteriaDetails')->get();
    }


    public function data()
    {
        return $this
            ->query()
            ->when($this->sortBy !== '', function ($query) {
                $sortColumn = explode('.', $this->sortBy);
                $sortDirection = $this->sortDirection;

                if ($sortColumn[0] === 'student') {
                    $column = $sortColumn[1];
                    if ($column === 'studentScore') {
                        $query->join('student_scores', 'student_scores.student_id', '=', 'students.id')
                            ->orderBy('student_scores.weight', $sortDirection);
                    } else if ($column === 'status') {
                        $query->orderBy('students.status', $sortDirection);
                    } else if ($column === 'gender') {  
                        $query->orderBy('students.gender', $sortDirection);
                    }
                } else {
                    $query->orderBy($this->sortBy, $sortDirection);
                }
            })
            ->paginate($this->perPage);
    }


    public function modalOpen($id = null)
    {

        $criteria = Criteria::all()->sortBy('symbol');

        foreach ($criteria as $value) {
            $this->form->criteriaSelections[$value->id] = null;
        }

        if (@$id) {
            $this->studentIdUpdate = $id;
            $student = Student::with([
                'user',
                'studentScore' => function ($q) {
                    $q
                        ->where('year', Carbon::now()->year)
                        ->with('criteriaDetails');
                }
            ])->where('id', $id)->first();

            $this->form->name = $student->user->name;
            $this->form->gender = $student->gender;
            $this->form->address = $student->address;
            $this->form->id = $student->id;
            $this->form->email = $student->user->email;
            
            foreach ($student->studentScore[0]->criteriaDetails as $value) {
                $this->form->criteriaSelections[$value->criteria_id] = $value->id;
            }
        }

        $this->dispatch($this->name);
        $this->showModal = true;
    }


    public function hideModal() {
        $this->dispatch($this->name);
        $this->form->reset();
        $this->form->resetValidation();
        $this->showModal = false;
    }


    public function delete($id) {
        Student::find($id)->delete();
    }


    public function columns(): array
    {
        $criteriaColumn = Criteria::all()->map(fn ($data, $index) => Column::make("student.student_score.0.criteria_details.{$index}.classification", $data->name));
        return [
            Column::make('name', 'Name'),
            Column::make('student.gender', 'Gender')->component('table.gender'),
            ...$criteriaColumn,
            Column::make('student.status', 'Status')->component('table.status'),
            Column::make('student.id', 'Action')->component('table.action'),
        ];
    }


    public function render()
    {
        return view('livewire.student-table');
    }
}
