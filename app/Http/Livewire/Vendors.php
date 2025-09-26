<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Vendor;

class Vendors extends Component
{
    public $VendorId;

    public function mount()
    {
        $this->VendorId = 100;
    }

    public function render()
    {
        return view('livewire.vendors', ['vendors' => Vendor::all(),]);
    }

    public function updateVendorId($value)
    {
        $this->VendorId = $value;
    }
}
