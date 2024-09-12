<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductModel;

class Accessories extends Component
{
    public function render()
    {
        $accessories = ProductModel::where('is_accessories', true)->where('status', true)->get();

        return view('livewire.accessories', compact('accessories'));
    }
}
