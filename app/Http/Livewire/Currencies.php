<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Currency;

class Currencies extends Component
{
    public function render()
    {
        $currencies = Currency::get();
        return view('livewire.currencies', compact('currencies'));
    }
}
