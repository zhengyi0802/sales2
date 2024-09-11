<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Catagory;

class Catagories extends Component
{
    public function render()
    {
        return view('livewire.catagories', ['catagories' => Catagory::all(),]);
    }
}
