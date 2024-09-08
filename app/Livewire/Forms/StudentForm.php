<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use App\Models\StudentScore;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class StudentForm extends Form
{
    use WithFileUploads;

    public string $id = '';
    public string $name = '';
    public string $gender = '';
    public $photoProfile;
    public string $address = '';
    public string $email = '';
    public bool $status = false;
    public ?string $password = null;


    public array $criteriaSelections = [];


    public function rules()
    {
        $rules = [
            'name' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'email' => 'required',
            'photoProfile' => 'image',
            'criteriaSelections.*' => 'required'
        ];

        if (!$this->id) {
            $rules = [
                ...$rules,
                'password' => 'required'
            ];
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'name.required' => 'Nama siswa harus diisi.',
            'gender.required' => 'Jenis kelamin harus diisii.',
            'address.required' => 'Alamat harus diiisi.',
            'email.required' => 'Email harus diisi.',
            'criteriaSelections.*' => 'Kriteria harus diisi',
            'password' => 'Passwoard harus  diisi'
        ];
    }


    public function store()
    {
        $this->validate();
        
        $userForm = $this->only(['email', 'password', 'name']);
        $studentForm = $this->only(['address', 'gender']);

        DB::beginTransaction();

        $user = User::create([
            'name' => $userForm['name'],
            'email' => $userForm['email'],
            'password' => $userForm['password']
        ]);

        $pp = $this->photoProfile->store('public');
        $pp = explode('/', $pp);

        $student = Student::create([
            'user_id' => $user->id,
            'address' => $studentForm['address'],
            'gender' => $studentForm['gender'],
            'status' => $this->status,
            'photo_profile' => $pp[1]
        ]);

        $studentScore = StudentScore::create([
            'student_id' => $student->id,
            'year' => now()->year
        ]);

        $studentScore->criteriaDetails()->attach($this->criteriaSelections);

        DB::commit();
        $this->reset(); 
    }


    public function update($id) {
        $this->validate();

        $userForm = $this->password == null
                        ? $this->only(['email', 'name'])
                        : $this->only(['email', 'name', 'password']);
        $studentForm = $this->only(['address', 'gender']);

        DB::beginTransaction();

        $student = Student::with('user')->get()->find($id);
        $pp = $this->photoProfile->store('public');
        $pp = explode('/', $pp);
        $student->update([
            ...$studentForm,
            'photo_profile' => $pp[1]
        ]);
        $student->user->update($userForm);
        
        $studentScore = StudentScore::where('student_id', $student->id)->get()->first();

        $criteria = [];
        foreach ($this->criteriaSelections as $value) {
            array_push($criteria, $value);
        }

        $studentScore->criteriaDetails()->sync($criteria);

        DB::commit();
        $this->reset();
    }
}
