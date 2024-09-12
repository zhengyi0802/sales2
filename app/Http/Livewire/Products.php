<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductModel;

class Products extends Component
{
    public function render()
    {
        $products = ProductModel::where('status', true)->get();

        return view('livewire.products', compact('products'));
    }
}
