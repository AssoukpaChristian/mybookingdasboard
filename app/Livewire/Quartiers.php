<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;


class Quartiers extends Component
{
    use WithPagination;

    #[validate('required|min:3|max:255|unique:quartiers,name')]
    public $name;

    #[validate('required')]
    public $commune_id;

    public $quartierId;
    public $showModaladd = false;
    public $showModaledit = false;

    protected $messages = [
        'name.required' => 'Le nom est requis !',
        'name.min' => 'Le nom doit être de 3 caractères minimum !',
        'commune.required' => 'La commune est requise !',
    ];

    public function resetfields(){
        $this->name = '';
        $this->commune_id = '';
        $this->resetValidation();
    }

    public function add_quartier(){
        $this->validate();

        \App\Models\Quartier::create([
            'name' => $this->name,
            'commune_id' => $this->commune_id,
        ]);

        $this->dispatch('close-add-modal');
        session()->flash('success', 'Quartier ajouté !');
        $this->resetFields();
    }

    public function edit_quartier($id){
        $quartier = \App\Models\Quartier::find($id);
        if ($quartier) {
            $this->quartierId = $quartier->id;
            $this->name = $quartier->name;
            $this->commune_id = $quartier->commune_id;
        } else {
            session()->flash('danger', 'Quartier non trouvé !');
        }
    }

    public function update_quartier(){
        $this->validate([
            'name'  => ['required', 'min:3', 'max:20', Rule::unique('quartiers')->ignore($this->quartierId)],
            'commune_id' => ['required'],
        ]);
        $quartier = \App\Models\Quartier::find($this->quartierId);
        if ($quartier) {
            $quartier->name = $this->name;
            $quartier->commune_id = $this->commune_id;
            $quartier->save();
            
            $this->dispatch('close-update-modal');
            session()->flash('success', 'Quartier mis à jour avec succès !');
            $this->resetfields();
        } else {
            session()->flash('danger', 'Quartier non trouvé !');
        }
    }

    public function delete_quartier($id){
        $quartier = \App\Models\Quartier::find($id);
        if ($quartier) {
            $quartier->delete();
            session()->flash('success', 'Quartier supprimé avec succès !');
        } else {
            session()->flash('danger', 'Quartier non trouvé !');
        }
    }

    public function mount()
    {
        $this->resetfields();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.quartiers',[
            'quartiers' => \App\Models\Quartier::latest()->paginate(10),]);
    }
}
