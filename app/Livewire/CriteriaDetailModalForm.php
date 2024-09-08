<?php

namespace App\Livewire;

use App\Livewire\Forms\CriteriaDetailForm;
use App\Models\Criteria;
use App\Models\CriteriaDetail;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class CriteriaDetailModalForm extends Component
{
    #[Modelable] 
    public $showModal;

    #[Reactive]
    public ?string $criteriaId = '';

    #[Reactive]
    public ?string $criteriaDetailId = '';

    public $criteria = null;

    public CriteriaDetailForm $form;


    public function rendered()
    {
        $this->form->reset();
        if ($this->criteriaDetailId != '') {
            $criteria = CriteriaDetail::find($this->criteriaDetailId);
            $this->form->classification = $criteria->classification;
            $this->form->weight = $criteria->weight;
            $this->form->id = $criteria->id;
        }
    }


    public function save()
    {
        $this->form->criteriaId = $this->criteriaId;
        if ($this->criteriaDetailId != '') $this->form->update($this->criteriaDetailId);
        else $this->form->store();
        $this->form->reset();
        $this->showModal = false;
    }

    
    public function render()
    {
        return view('livewire.criteria-detail-modal-form');
    }
}
