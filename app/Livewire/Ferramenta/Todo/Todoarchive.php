<?php

namespace App\Livewire\Ferramenta\Todo;

use App\Models\Ferramenta\Todo;
use Livewire\Component;

class Todoarchive extends Component
{
    protected $listeners = ['restore'];
    public $archives;

    public function mount()
    {
        $this->archives = Todo::withoutGlobalScopes()->where('is_archived', 1)->get();
    }

    public function restore($id)
    {
        $todo = Todo::withoutGlobalScopes()->findOrFail($id);
        $todo->is_archived = false;
        $todo->save();

        $this->archives = Todo::withoutGlobalScopes()->where('is_archived', 1)->get();

        $this->dispatch('swal:alert', [
            'type'  => 'success',
            'message' => 'Todo Restored Successfully!',
        ]);
    }

    public function render()
    {
        return view('livewire.ferramenta.todo.archive')->layout('livewire.ferramenta.todo.layout');
    }
}
