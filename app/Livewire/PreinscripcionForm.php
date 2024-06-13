<?php

namespace App\Livewire;

use Livewire\Component;

class PreinscripcionForm extends Component
{
    public function render()
    {
        return view('livewire.preinscripcion-form');
    }
    public function correcto()
    {
        return view('livewire.preinscripcion-correcta');
    }
}
