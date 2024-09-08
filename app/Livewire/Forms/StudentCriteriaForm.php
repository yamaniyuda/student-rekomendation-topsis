<?php

namespace App\Livewire\Forms;

use App\Models\Criteria;
use App\Rules\TotalWeight;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StudentCriteriaForm extends Form
{
    public string $year = '';
    public string $id = '';
    public string $studentId = '';
    public array $criteriaSelections = [];

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'symbol' => 'required',
            'criteria_weight' => [
                'required',
            ]
        ];

        if (empty($this->id)) {
            array_push($rules['criteria_weight'], new TotalWeight);
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'name.required' => 'Nama kriteria harus diisi.',
            'symbol.required' => 'Simbol harus diisi.',
            'criteria_weight.required' => 'Bobot harus diisi.',
        ];
    }


    public function store()
    {
        $criteria = Criteria::all()->sortBy('symbol');
        dd($criteria);
        $validate = $this->validate();
        $payload = [
            ...$validate,
            'criteria_weight' => (int) $validate['criteria_weight'],
            'preference_weight' => ((int) $validate['criteria_weight']) / 100
        ];
        Criteria::create($payload);
        $this->reset();
    }

    public function update(string $id)
    {
        $criteria = Criteria::all()->sortBy('symbol');
        $validate = $this->validate();
        $criteria = Criteria::find($id);
        $payload = [
            ...$validate,
            'criteria_weight' => (int) $validate['criteria_weight'],
            'preference_weight' => ((int) $validate['criteria_weight']) / 100
        ];
        $criteria->update($payload);
        $this->reset();
    }
}
