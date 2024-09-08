<?php

namespace App\Livewire;

use App\Livewire\Forms\CriteriaForm;
use App\Models\Criteria;
use App\Models\CriteriaType;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class FormCriteria extends Component
{
    #[Modelable] 
    public bool $showModal;

    #[Reactive]
    public ?string $criteriaId = '';

    public CriteriaForm $criteraiForm;

    public function rendered()
    {
        $this->criteraiForm->reset();
        if ($this->criteriaId != '') {
            $criteria = Criteria::find($this->criteriaId);
            $this->criteraiForm->name = $criteria->name;
            $this->criteraiForm->symbol = $criteria->symbol;
            $this->criteraiForm->criteria_weight = $criteria->criteria_weight;
            $this->criteraiForm->id = $criteria->id;
        }
    }

    public function save()
    {
        if ($this->criteriaId) $this->criteraiForm->update($this->criteriaId);
        else $this->criteraiForm->store();
        $this->showModal = false;
    }


    public function render()
    {
        return view('livewire.form-criteria');
    }
}
