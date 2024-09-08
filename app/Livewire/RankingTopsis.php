<?php

namespace App\Livewire;

use App\Helpers\TopsisHelper;
use App\Models\Criteria;
use App\Models\Student;
use App\Models\StudentScore;
use Livewire\Component;

class RankingTopsis extends Component
{
    public $yearOption;
    public $yearOptionSelect;
    public $rankings;
    public $showCalculateTopsis;

    public function mount()
    {
        $this->yearOption = StudentScore::selectRaw('year')
            ->groupBy('year')
            ->havingRaw('COUNT(year) > 1')
            ->orderBy('year', 'desc')
            ->pluck('year');

        $this->yearOptionSelect = $this->yearOption->first();
        $this->calculateRanking();
    }


    public function updatedYearOptionSelect()
    {
        $this->calculateRanking();
    }



    public function calculateRanking()
    {
        $criteriaStudent = Student::whereHas('studentScore', function ($query) {
            $query->where('year', $this->yearOptionSelect);
        })->get()->map(fn($data) => $data->getCriteria($this->yearOptionSelect));

        $criteria = Criteria::all()->pluck('criteria_weight', 'symbol')->toArray();
        $topsisHelper = new TopsisHelper($criteriaStudent, $criteria);
        $this->rankings = $topsisHelper->execute();
    }


    public function render()
    {
        return view('livewire.ranking-topsis');
    }
}
