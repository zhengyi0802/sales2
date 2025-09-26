<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;
use App\Models\NhpProduct;
use App\Models\Sales;

class NewOrder extends Component
{
    public $projects;
    public $sales;
    public $ProjectId;
    public $products = [];

    public function mount()
    {
        $this->projects = Project::all();
        $this->sales = Sales::all();
    }


    public function updatedProjecrId($param, $value)
    {
        $this->testupdate = $value;
        $project = Project::with('products')->find($value);
        $this->products = $project ? $project->products->toArray() : [];
    }


    public function render()
    {
        return view('livewire.new-order');
    }
}
