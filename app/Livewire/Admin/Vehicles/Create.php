<?php

namespace App\Livewire\Admin\Vehicles;

use Livewire\Component;

class Create extends Component
{
    public $brands;
    public $models;
    public $types;
    public $colors;
    public $selectedColorId;
    
    
    public function mount($brands, $models, $types, $colors)
    {
        $this->brands = $brands;
        $this->models = $models;
        $this->types = $types;
        $this->colors = $colors;
        $this->selectedColorId = $colors->first()->id;
    }

    public function selectColor($colorId)
    {
        $this->selectedColorId = $colorId;
    }
     
    
    public function render()
    {
        return view('livewire.admin.vehicles.create');
    }
}
