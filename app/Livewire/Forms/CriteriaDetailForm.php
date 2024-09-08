<?php

namespace App\Livewire\Forms;

use App\Models\CriteriaDetail;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CriteriaDetailForm extends Form
{
    public $classification = '';
    public $weight = '';
    public $criteriaId = '';
    public $id = '';

    public function rules()
    {
        $rules = [
            'classification' => 'required',
            'caption' => 'required' 
        ];

        return $rules;
    }
    

    public function messages()
    {
        return [
            'classification.required' => 'Nama kriteria harus diisi.',
            'weight.required' => 'Bobot harus diisi.',
        ];
    }


    public function update(string $id)
    {
        $criteria = CriteriaDetail::find($id);
        $criteria->update([
            'weight' => $this->weight,
            'classification' => $this->classification
        ]);
    }

    public function store()
    {
        CriteriaDetail::create([
            'weight' => $this->weight,
            'classification' => $this->classification,
            'criteria_id' => $this->criteriaId
        ]);
    }
}
