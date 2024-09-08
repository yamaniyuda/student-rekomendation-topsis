<?php
namespace App\Helpers;

use Illuminate\Support\Collection;

class TopsisHelper
{
    public $data;
    public $weights;

    public function __construct(Collection $data, array $weights)
    {
        $this->data = $data;
        $this->weights = $weights; // Bobot untuk setiap kriteria
    }

    /**
     * Conversion data to fuzzy structure
     */
    public function oneStep()
    {
        return $this;
    }

    /**
     * Normalization
     */
    public function twoStep()
    {
        $kriteria = $this->data->map(function ($item) {
            return $item->except('name');
        });

        $weightCriteria = $kriteria[0]->mapWithKeys(fn ($item, $key) => [$key => 0]);
        foreach ($kriteria as $kt) {
            foreach ($kt as $key => $value) {
                $weightCriteria[$key] += pow($value['weight'], 2);
            }
        }

        foreach ($weightCriteria as $key => $value) {
            $weightCriteria[$key] = sqrt($weightCriteria[$key]);
        }

        $normalizedMatrix = $kriteria->map(function ($data, $index) use ($weightCriteria) {
            $data = $data->map(function ($dt, $key) use ($weightCriteria) {
                $dt['weight'] = $dt['weight'] / $weightCriteria[$key];
                return $dt;
            });
            return $data->merge([
                'name' => $this->data[$index]['name']
            ]);
        });
        

        return [$weightCriteria,$normalizedMatrix];
    }

    /**
     * Weighting
     */
    public function threeStep(Collection $normalizedMatrix)
    {
        $weightedMatrix = $normalizedMatrix->map(function ($item) {
            $itemWithoutName = $item->except('name');
            $weightedValues = $itemWithoutName->map(function ($value, $key) {
                return $value['weight'] * $this->weights[$key];
            });

            return $weightedValues->merge(['name' => $item->get('name')]);
        });

        return $weightedMatrix;
    }

    /**
     * Determining Ideal and Negative Ideal Solutions
     */
    public function fourStep(Collection $weightedMatrix)
    {
        $idealPositive = $weightedMatrix->first()->keys()->mapWithKeys(function ($key) use ($weightedMatrix) {
            return [$key => $weightedMatrix->pluck($key)->max()];
        });

        $idealNegative = $weightedMatrix->first()->keys()->mapWithKeys(function ($key) use ($weightedMatrix) {
            return [$key => $weightedMatrix->pluck($key)->min()];
        });

        return [$idealPositive, $idealNegative];
    }

    /**
     * Calculating Distance to Ideal and Negative Ideal Solutions
     */
    public function fiveStep(Collection $weightedMatrix, Collection $idealPositive, Collection $idealNegative)
    {
        $distances = $weightedMatrix->map(function ($item) use ($idealPositive, $idealNegative) {
            $distancePositive = sqrt($idealPositive->keys()->map(function ($key) use ($item, $idealPositive) {
                return pow(floatval($item[$key]) - floatval($idealPositive[$key]), 2);
            })->sum());

            $distanceNegative = sqrt($idealNegative->keys()->map(function ($key) use ($item, $idealNegative) {
                return pow(floatval($item[$key]) - floatval($idealNegative[$key]), 2);
            })->sum());

            return $item->merge([
                'distance_positive' => $distancePositive,
                'distance_negative' => $distanceNegative
            ]);
        });

        return $distances;
    }

    /**
     * Calculating Preference Scores
     */
    public function sixStep(Collection $distances)
    {
        $preferenceScores = $distances->map(function ($item) {
            $distancePositive = $item['distance_positive'];
            $distanceNegative = $item['distance_negative'];

            $preferenceScore = $distanceNegative / ($distancePositive + $distanceNegative);
            
            return $item->merge(['preference_score' => $preferenceScore]);
        });

        return $preferenceScores;
    }


    public function finalStep(Collection $preferenceScores)
    {
        return $this->data->map(function ($value, $index) use ($preferenceScores) {
            return $value->merge(['preference_score' => $preferenceScores[$index]['preference_score']]);
        });
    }


    /**
     * Execute TOPSIS Algorithm
     */
    public function execute()
    {
        [$weightCriteria, $normalizedMatrix] = $this->twoStep();
        $weightedMatrix = $this->threeStep($normalizedMatrix);
        [$idealPositive, $idealNegative] = $this->fourStep($weightedMatrix);
        $distances = $this->fiveStep($weightedMatrix, $idealPositive, $idealNegative);
        $preferenceScores = $this->sixStep($distances);
        $finalResult = $this->finalStep($preferenceScores);

        return collect([
            'step_one' => [
                'weight_criteria' => $weightCriteria,
                'normalize_matrix' => $normalizedMatrix
            ],
            'step_two' => $weightedMatrix,
            'step_three' => $distances,
            'step_four' => $preferenceScores,
            'final_result' => $finalResult->sortByDesc('preference_score'),
        ]);
    }
}
