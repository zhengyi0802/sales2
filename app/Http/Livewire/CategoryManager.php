<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Catagory;

class CategoryManager extends Component
{
    use WithPagination;

    public $name, $category_id, $creator_id;
    public $isEditMode = false;
    public $modalOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $categories = Catagory::latest()->paginate(10);
        return view('livewire.category-manager', compact('categories'));
    }

    public function openModal()
    {
        $this->resetInput();
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
        $this->isEditMode = false;
    }

    public function resetInput()
    {
        $this->name = '';
        $this->category_id = null;
        $this->creator_id = auth()->user()->id;
    }

    public function store()
    {
        $this->validate();

        Catagory::create(['name' => $this->name, 'created_by' => $this->creator_id]);

        session()->flash('message', '分類已新增');
        $this->closeModal();
    }

    public function edit($id)
    {
        $category = Catagory::findOrFail($id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->creator_id = $category->created_by;
        $this->isEditMode = true;
        $this->modalOpen = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->category_id) {
            $category = Catagory::find($this->category_id);
            $category->update(['name' => $this->name]);
            session()->flash('message', '分類已更新');
            $this->closeModal();
        }
    }

    public function delete($id)
    {
        $category = Catagory::find($id);
        if ($category->status) {
            $category->status = false;
            $category->save();
        } else {
            Catagory::find($id)->delete();
        }
        session()->flash('message', '分類已刪除');
    }
}
