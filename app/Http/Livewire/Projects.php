<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class Projects extends Component
{
    public function render()
    {
        $projects = Project::where('status', true)->get();
        return view('livewire.projects', compact('projects'));
    }
}
