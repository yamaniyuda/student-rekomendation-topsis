<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'sertifikat kursus',
                'symbol' => 'C1',
                'criteria_weight' => 20,
                'preference_weight' => 0.20
            ],
            [
                'name' => 'nilai rata-rata kursus',
                'symbol' => 'C2',
                'criteria_weight' => 25,
                'preference_weight' => 0.25
            ],
            [
                'name' => 'skil atau kemampuan',
                'symbol' => 'C3',
                'criteria_weight' => 25,
                'preference_weight' => 0.25
            ],
            [
                'name' => 'aktif di kelas',
                'symbol' => 'C4',
                'criteria_weight' => 20,
                'preference_weight' => 0.20
            ],
            [
                'name' => 'kehadiran',
                'symbol' => 'C5',
                'criteria_weight' => 10,
                'preference_weight' => 0.10
            ]
        ];
        Criteria::upsert($data, uniqueBy: ['id']);
    }
}
