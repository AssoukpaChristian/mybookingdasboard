<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;


class Communes extends Component
{
    use WithPagination;

    #[validate('required|min:3|max:255|unique:communes,name')]
    public $name;

    #[validate('required')]
    public $pays_id;

    public $communeId;
    public $showModaladd = false;
    public $showModaledit = false;

    protected $messages = [
        'name.required' => 'Le nom est requis !',
        'name.min' => 'Le nom doit être de 3 caractères minimum !',
        'pays.required' => 'Le pays est requis !',
    ];

    public function resetfields(){
        $this->name = '';
        $this->pays_id = '';
        $this->resetValidation();
    }

    public function resetform(){
        $this->resetfields();
        $this->communeId = null;
    }

    public function hideAllModals(){
        $this->showModaladd = false;
        $this->showModaledit = false;
    }

    public function add_commune(){
        $this->validate();
        $this->dispatch('close-add-modal');

        \App\Models\Commune::create([
            'name' => $this->name,
            'pays_id' => $this->pays_id,
        ]);

        session()->flash('success', 'Commune ajoutée !');
        $this->resetFields();
    }

    public function edit_commune($id){
        $commune = \App\Models\Commune::find($id);
        if ($commune) {
            $this->communeId = $commune->id;
            $this->name = $commune->name;
            $this->pays_id = $commune->pays_id;
        } else {
            session()->flash('danger', 'Commune non trouvée !');
        }
    }
    public function update_commune(){
        $this->validate([
            'name'  => ['required', 'min:3', 'max:20', Rule::unique('communes')->ignore($this->communeId)],
            'pays_id' => ['required'],
        ]);
        $commune = \App\Models\Commune::find($this->communeId);
        if ($commune) {
            $commune->name = $this->name;
            $commune->pays_id = $this->pays_id;
            $commune->save();

            session()->flash('success', 'Commune mise à jour avec succès !');
            $this->resetfields();
            $this->dispatch('close-update-modal');
        } else {
            session()->flash('danger', 'Commune non trouvée !');
        }
    }

    public function delete_commune($id){
        $commune = \App\Models\Commune::find($id);
        if ($commune) {
            $commune->delete();
            session()->flash('success', 'Commune supprimée avec succès !');
        } else {
            session()->flash('danger', 'Commune non trouvée !');
        }
    }

    public function mount()
    {
        $this->resetfields();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.communes',[
            'communes' => \App\Models\Commune::latest()->paginate(10),]);
    }
}
