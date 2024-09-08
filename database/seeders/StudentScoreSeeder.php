<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentScore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Student::all() as $student) {
            StudentScore::create([
                'student_id' => $student->id,
                'weight' => 0
            ]);
        }
    }
}
