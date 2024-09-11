<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Vendor;

class Vendors extends Component
{
    public function render()
    {
        return view('livewire.vendors', ['vendors' => Vendor::all(),]);
    }
}
