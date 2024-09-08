<?php

namespace App\Livewire\Table;

class Column
{
    public string $component = 'table.column';

    public string $key;

    public string $label;

    public function __construct($key, $label)
    {
        $this->key = $key;
        $this->label = $label;
    }


    public function component($component)
    {
        $this->component = $component;

        return $this;
    }



    public static function make($key, $label)
    {
        return new static($key, $label);
    }
}
