<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;


class Residences extends Component
{
    use WithPagination;

    #[validate('required|min:3|max:50|unique:residences,name')]
    public $name;

    #[validate('required')]
    public $quartier_id;

    public $contact;

    #[validate('required|integer|min:1')]
    public $pieces;

    #[validate('required|integer')]
    public $prix;

    public $residenceId;
    public $showModaladd = false;
    public $showModaledit = false;

    protected $messages = [
        'name.required' => 'Le nom est requis !',
        'name.min' => 'Le nom doit être de 3 caractères minimum !',
        'name.max' => 'Le nom doit être de 50 caractères maximum !',
        'name.unique' => 'Le nom doit être unique !',
        'quartier_id.required' => 'Le quartier est requis !',
        'pieces.required' => 'Le nombre de pièces est requis !',
        'pieces.integer' => 'Le nombre de pièces doit être un entier !',
        'pieces.min' => 'Le nombre de pièces doit être au moins 1 !',
        'prix.required' => 'Le prix est requis !',
        'prix.integer' => 'Le prix doit être un entier !',
    ];

    public function resetfields(){
        $this->name = '';
        $this->quartier_id = '';
        $this->contact = '';
        $this->pieces = '';
        $this->prix = '';
        $this->residenceId = '';
        $this->resetValidation();
    }

    public function add_residence(){
        $this->validate();

        \App\Models\Residence::create([
            'name' => $this->name,
            'quartier_id' => $this->quartier_id,
            'contact' => $this->contact,
            'pieces' => $this->pieces,
            'prix' => $this->prix,
        ]);

        $this->dispatch('close-add-modal');
        session()->flash('success', 'Residence ajoutée !');
        $this->resetFields();
    }

    public function edit_residence($id){
        $residence = \App\Models\Residence::find($id);
        if ($residence) {
            $this->residenceId = $residence->id;
            $this->name = $residence->name;
            $this->quartier_id = $residence->quartier_id;
            $this->contact = $residence->contact;
            $this->pieces = $residence->pieces;
            $this->prix = $residence->prix;
        } else {
            session()->flash('danger', 'Résidence non trouvée !');
        }
    }

    public function update_residence(){
        $this->validate([
            'name'  => ['required', 'min:3', 'max:20', Rule::unique('residences')->ignore($this->residenceId)],
            'quartier_id' => ['required'],
            'pieces' => ['required', 'integer', 'min:1'],
            'prix' => ['required', 'integer'],
        ]);
        $residence = \App\Models\Residence::find($this->residenceId);
        if ($residence) {
            $residence->name = $this->name;
            $residence->quartier_id = $this->quartier_id;
            $residence->contact = $this->contact;
            $residence->pieces = $this->pieces;
            $residence->prix = $this->prix;
            $residence->save();

            $this->dispatch('close-update-modal');
            session()->flash('success', 'Résidence mise à jour avec succès !');
            $this->resetfields();
        } else {
            session()->flash('danger', 'Résidence non trouvée !');
        }
    }

    public function delete_residence($id){
        $residence = \App\Models\Residence::find($id);
        if ($residence) {
            $residence->delete();
            session()->flash('success', 'Résidence supprimée avec succès !');
        } else {
            session()->flash('danger', 'Résidence non trouvée !');
        }
    }

    public function mount()
    {
        $this->resetfields();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.residences',[
            'residences' => \App\Models\Residence::latest()->paginate(10),]);
    }
}
