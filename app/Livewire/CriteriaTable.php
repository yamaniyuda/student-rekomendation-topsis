<?php

namespace App\Livewire;

use App\Livewire\Table\Column;
use App\Livewire\Table\Table;
use App\Models\Criteria;
use App\Models\CriteriaDetail;
use App\Models\CriteriaType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CriteriaTable extends Table
{
    public Collection $criteriaas;
    public ?string $criteriaId;
    public $criteriaDetailModal = false;
    public ?string $criteriaDetailId = '';
    public $criteriaIdForDetail = '';

    public function __construct()
    {
        $this->criteriaas = Criteria::all();
    }

    public function query() : Builder
    {
        return Criteria::with('criteriaDetails')->orderBy('symbol');
    }

    
    public function modalDetailCriteriaOpen(string $criteriaId, string $detailCriteriaId = null)
    {
        $this->criteriaIdForDetail = $criteriaId;
        $this->criteriaDetailId = $detailCriteriaId ?? '';
        $this->criteriaDetailModal = true;
    }


    public function modalOpen()
    {
        $this->dispatch($this->name);
        $this->showModal = true;
        $this->criteriaId = null;
    }


    public function update(string $id)
    {
        $this->modalOpen();
        $this->criteriaId = $id;
    }

    public function delete(string $id)
    {
        Criteria::find($id)->delete();
    }


    public function deleteDetailCriteria(string $detailCriteria) {
        CriteriaDetail::find($detailCriteria)->delete();
    }


    public function columns(): array
    {
        return [
            Column::make('', 'No'),
            Column::make('name', 'Nama'),
            Column::make('symbol', 'Symbol'),
            Column::make('criteria_weight', 'Weight'),
            Column::make('id', 'Aksi')->component('table.action-criteria')
        ];
    }



    public function render()
    {
        return view('livewire.criteria-table');
    }
}
