<?php

namespace App\Livewire\Table;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination,  WithoutUrlPagination;

    public string $title;
    public string $desc;
    public int $perPage = 10;
    public int $page = 1;
    public string $sortBy = 'created_at';
    public string $sortDirection = 'desc';
    public bool $showModal = false;
    public string $name = 'table';


    public abstract function query(): Builder;

    public abstract function columns(): array;


    public function modalOpen()
    {
        $this->dispatch($this->name);
        $this->showModal = true;
    }


    public function data()
    {
        return $this
            ->query()
            ->when($this->sortBy !== '', function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->perPage);
    }

    public function sort($key)
    {
        $this->resetPage();

        if ($this->sortBy === $key) {
            $direction = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            $this->sortDirection = $direction;

            return;
        }

        $this->sortBy = $key;
        $this->sortDirection = 'asc';
    }


    public function render()
    {
        return view('livewire.table');
    }
}
