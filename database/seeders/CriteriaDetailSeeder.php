<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\CriteriaDetail;
use Illuminate\Database\Seeder;

class CriteriaDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criteriaDetails = [
            [
                'criteria' => 'C1',
                'details' => [
                    ['classification' => '1-2 sertifikat', 'weight' => 1],
                    ['classification' => '>2-3 sertifikat', 'weight' => 2],
                    ['classification' => '>4 sertifikat', 'weight' => 3]
                ]
            ],
            [
                'criteria' => 'C2',
                'details' => [
                    ['classification' => '60-70', 'weight' => 1],
                    ['classification' => '70-80', 'weight' => 2],
                    ['classification' => '>90', 'weight' => 3]
                ]
            ],
            [
                'criteria' => 'C3',
                'details' => [
                    ['classification' => 'kurang baik', 'weight' => 1],
                    ['classification' => 'cukup baik', 'weight' => 2],
                    ['classification' => 'baik', 'weight' => 3],
                    ['classification' => 'sangat baik', 'weight' => 4]
                ]
            ],
            [
                'criteria' => 'C4',
                'details' => [
                    ['classification' => 'kurang aktif', 'weight' => 1],
                    ['classification' => 'aktif', 'weight' => 2],
                    ['classification' => 'sangat aktif', 'weight' => 3]
                ]
            ],
            [
                'criteria' => 'C5',
                'details' => [
                    ['classification' => '<60%', 'weight' => 1],
                    ['classification' => '>60%-75%', 'weight' => 2],
                    ['classification' => '>75%-90%', 'weight' => 3],
                    ['classification' => '100%', 'weight' => 4]
                ]
            ]
        ];

        // Convert criteria details to a flat collection with criteria_id
        $data = collect($criteriaDetails)->flatMap(function ($criteriaDetail, $index) {
            $criteriaId = Criteria::skip($index)->first()->id;

            return collect($criteriaDetail['details'])->map(function ($detail) use ($criteriaId) {
                return array_merge($detail, ['criteria_id' => $criteriaId]);
            });
        })->toArray();

        // Perform the upsert operation
        CriteriaDetail::upsert($data, ['classification', 'criteria_id'], ['weight']);
    }
}
