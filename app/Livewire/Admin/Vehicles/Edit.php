<?php

namespace App\Livewire\Admin\Vehicles;

use Livewire\Component;

class Edit extends Component
{
    public $vehicle, $brands, $models, $types, $colors, $selectedColorId;
    
    
    public function mount($vehicle, $brands, $models, $types, $colors)
    {
        $this->vehicle = $vehicle;
        $this->brands = $brands;
        $this->models = $models;
        $this->types = $types;
        $this->colors = $colors;
        $this->selectedColorId = $vehicle->color_id;
    }

    public function selectColor($colorId)
    {
        $this->selectedColorId = $colorId;
    }
    
    public function render()
    {
        return view('livewire.admin.vehicles.edit');
    }
}
